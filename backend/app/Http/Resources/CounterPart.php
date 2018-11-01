<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterPart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'birth_date' => $this->birth_date,
            'rg' => $this->rg,
            'rg_issuer' => $this->rg_issuer,
            'gender' => $this->gender,
            'profession' => $this->profession,
            'note' => $this->note,
            'addresses' => json_decode($this->addresses, true),
            'document_type'=>$this->document_type,
            'document_number'=>$this->document_number,
            'fantasy_name'=>$this->fantasy_name
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'version' => '1.0.0'
        ];
    }
}
