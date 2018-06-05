<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use App\Models\Postcode;
use Illuminate\Http\Response;

class PostcodeController extends Controller
{
    public function __construct()
    {
        $this->http = new Client;
    }

    /**
     * @param $cep
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function find($cep)
    {
        $cep = $this->sanitize($cep);

        /** @var Postcode $postcode */
        $postcode = Postcode::where('cep', $cep)->first();

        if ($postcode) {
            return JsonResponse::create($postcode->toArray(), Response::HTTP_OK);
        }

        /** @var Postcode $newPostcode */
        $newPostcode = $this->search($cep);

        if ($newPostcode) {
            $newPostcode->saveOrFail();

            return JsonResponse::create($newPostcode->toArray(), Response::HTTP_OK);
        }

        return JsonResponse::create([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $cep
     * @return Postcode|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    private function search($cep)
    {
        try {
            $response = $this->http->request('GET', 'https://viacep.com.br/ws/' . $cep . '/json');

            $attributes = json_decode($response->getBody(), true);

            if (array_key_exists('erro', $attributes) && $attributes['erro'] === true) {
                return null;
            }

            /** @var Postcode $postcode */
            $postcode = new Postcode();

            $postcode->cep = $this->sanitize($attributes['cep']);
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

    private function sanitize($input) {
        $input = trim($input);
        $input = str_replace(".", "", $input);
        $input = str_replace(",", "", $input);
        $input = str_replace("-", "", $input);
        $input = str_replace("/", "", $input);

        return $input;
    }
}
