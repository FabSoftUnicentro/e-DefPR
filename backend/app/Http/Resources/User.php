<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'cpf' => $this->cpf,
            'birth_date' => $this->birth_date,
            'rg' => $this->rg,
            'rg_issuer' => $this->rg_issuer,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'profession' => $this->profession,
            'note' => $this->note,
            'addresses' => json_decode($this->addresses, true),
            'must_change_password' => $this->must_change_password
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }

    public function role()
	{
		return $this->hasOne('App\Role', 'id', 'role_id');
    }
    
	public function hasRole($roles)
	{
		$this->have_role = $this->getUserRole();
		if($this->have_role->name == 'Root') {
			return true;
		}
		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($need_role)) {
					return true;
				}
			}
		} else{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
    }
    
	private function getUserRole()
	{
		return $this->role()->getResults();
    }
    
	private function checkIfUserHasRole($need_role)
	{
		return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
	}

}
