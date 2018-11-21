<?php

namespace App\Http\Controllers\Postcode;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use App\Models\Postcode;
use Illuminate\Http\Response;
use App\Http\Resources\Postcode as PostcodeResource;

class PostcodeSearch extends Controller
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client;
    }

    /**
     * @param $postcodeValue
     * @return PostcodeResource|JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function __invoke($postcodeValue)
    {
        $postcodeValue = $this->sanitize($postcodeValue);

        /** @var Postcode $postcode */
        $postcode = Postcode::where('postcode', $postcodeValue)->first();

        if ($postcode) {
            return new PostcodeResource($postcode);
        }

        /** @var Postcode $newPostcode */
        $newPostcode = $this->search($postcodeValue);

        if ($newPostcode) {
            $newPostcode->saveOrFail();

            return new PostcodeResource($newPostcode);
        }

        return JsonResponse::create([], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $postcode
     * @return Postcode|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    private function search($postcode)
    {
        try {
            $response = $this->httpClient->request("GET", "https://viacep.com.br/ws/{$postcode}/json", [
                'timeout' => 10
            ]);

            $attributes = json_decode($response->getBody(), true);

            if (array_key_exists('erro', $attributes) && $attributes['erro'] === true) {
                return null;
            }

            /** @var Postcode $postcode */
            $postcode = new Postcode();

            $postcode->postcode = $this->sanitize($attributes['cep']);
            $postcode->street = $attributes['logradouro'];
            $postcode->complement = $attributes['complemento'];
            $postcode->neighborhood = $attributes['bairro'];
            $postcode->city = $attributes['localidade'];
            $postcode->uf = $attributes['uf'];
            $postcode->unity = $attributes['unidade'];
            $postcode->ibge_code = $attributes['ibge'] ? intval($attributes['ibge']) : null;
            $postcode->gia_code = $attributes['gia'] ? intval($attributes['gia']) : null;

            return $postcode;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $input
     * @return mixed|string
     */
    private function sanitize($input)
    {
        $input = trim($input);
        $input = str_replace(".", "", $input);
        $input = str_replace(",", "", $input);
        $input = str_replace("-", "", $input);
        $input = str_replace("/", "", $input);

        return $input;
    }
}
