import React, { Component } from "react";
import {
    Dropdown,
    Label
} from "office-ui-fabric-react";

import Fetcher from "../../helpers/Fetcher";

import "../../styles/Dropdowns.css";

export class DropdownStateCity extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            selectedState: null,
            stateList: [],
            cityList: []
        };

        this.onSelectState = this.onSelectState.bind(this);
    }

    componentDidMount()
    {
        if(this.state.stateList.length === 0) {
            Fetcher.cachedGet("/estado/all")
            .then(response => this.setState({ stateList: response.data }));
        }
    }

    componentWillUpdate(nextProps, nextState)
    {
        if(nextState.selectedState && nextState.selectedState !== this.state.selectedState) {
            Fetcher.cachedGet(`/cidade/estado/${nextState.selectedState}`)
            .then(response => this.setState({ cityList: response.data }));
        }
    }

    onSelectState({ target })
    {
        this.setState({ 
            selectedState: target.value,
            cityList: []
        });
    }

    render()
    {
        const { stateList, cityList } = this.state;

        return <div className="textfield-group" style={{ marginBottom: 0 }}>
            <div className="ms-Dropdown-container" style={{ flex: "initial" }}>
                <Label>Estado</Label>
                <select 
                    className="ms-Dropdown ms-Custom-Dropdown" 
                    disabled={stateList.length===0}
                    defaultValue={"empty"}
                    onChange={this.onSelectState}
                >
                    <option id={"empty"} hidden>UF</option>
                    { stateList.map(st => (
                        <option key={st.estadoId} value={st.estadoId}>{ st.uf }</option>
                    )) }
                </select>
            </div>

            <div className="ms-Dropdown-container" style={{ marginLeft: 0 }}>
                <Label>Cidade</Label>
                <select 
                    className="ms-Dropdown ms-Custom-Dropdown" 
                    disabled={cityList.length===0}
                    style={{ borderLeft:"none" }}
                    defaultValue={(this.state.selectedState===null)?"nouf":(cityList.length===0)?"nocity":"empty"}
                    onChange={ ({target}) => this.props.onChanged({ cidadeId: target.value }) }
                >
                    <option value={"nouf"} hidden>Escolha um estado..</option>
                    <option value={"nocity"} hidden>Carregando cidade..</option>
                    <option value={"empty"} hidden>Selecione a cidade</option>
                    { cityList.map(st => (
                        <option key={st.cidadeId} value={st.cidadeId}>{ st.nome }</option>
                    )) }
                </select>
            </div>
        </div>;
    }
}

export const DropdownGender = ({ name, onChanged }) => (
    <Dropdown name={name} onChanged={(item) => onChanged(item.key)} label="Genêro" placeHolder="Selecione" options={[
        { key: "masculino", text: "Masculino" },
        { key: "feminino", text: "Feminino" },
    ]} />
);

export const DropdownCivilState = ({ name, onChanged }) => (
    <Dropdown name={name} onChanged={(item) => onChanged(item.key)} label="Estado Civil" placeHolder="Selecione" options={[
        { key: "solteiro", text: "Solteiro(a)" },
        { key: "casado", text: "Casado(a)" },
    ]} />
);