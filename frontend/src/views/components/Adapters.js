import React, { Component } from "react";
import { TextField, Label, DatePicker } from "office-ui-fabric-react";
import Select, { Async } from "react-select";
import VirtualizedSelect from 'react-virtualized-select';
import { Field } from "react-final-form";

import fetcher from "../../helpers/fetcher";

export const TextFieldAdapter = ({ input, label, meta, ...rest }) => (
    <TextField 
        label={label}
        {...rest}
        onChanged={value => input.onChange(value)} 
    />
);

export const DatePickerAdapter = ({ input, label, meta, ...rest }) => (
    <DatePicker label={label} {...rest} />
);

export const SelectAdapter = ({ input, label, options, ...rest }) => (
    <div className="md-TextField-wrapper">
        <Label>{label}</Label>
        <BasicSelect
            {...rest}
            placeholder="Selecione..."
            noResultsText="Nenhum resultado encontrado."
            options={options}
        />
    </div>
);

export const GenderSelect = ({ input, name, label, ...rest }) => (
    <Field 
        name={name} 
        label={label} 
        {...rest} 
        component={SelectAdapter} 
        searchable={false}
        onChange={ value => input.onChange(value) }
        options={[
            { value: "masculino", label: "Masculino" },
            { value: "feminino", label: "Feminino" }
        ]}
    />
);

export const CivilStateSelect = ({ input, name, label, ...rest }) => (
    <Field 
        name={name} 
        label={label} 
        {...rest} 
        component={SelectAdapter} 
        searchable={false}
        onChange={ value => input.onChange(value) }
        options={[
            { value: "Solteiro(a)", label: "Solteiro(a)" },
            { value: "Casado(a)", label: "Casado(a)" },
            { value: "Separado(a)/divorciado(a)", label: "Separado(a)/divorciado(a)" },
            { value: "Viúvo(a)", label: "Viúvo(a)" },
            { value: "Outro", label: "Outro" }
        ]}
    />
);

export const VirtualizedSelectAdapter = ({ input, label, options, ...rest }) => (
    <div className="ms-TextField-wrapper">
        <Label>{label}</Label>
        <VirtualizedSelect
            {...rest}
            placeholder="Selecione..."
            noResultsText="Nenhum resultado encontrado."
            options={options}
        />
    </div>
);

export const CitySelectAdapter = ({ input, label, options, ...rest }) => (
    <CitySelect 
        label={label}
        {...rest}
        onChange={ value => input.onChange(value) }
    />
);

class BasicSelect extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            value: undefined
        }
    }

    onChange(input, name) {
        this.setState({ value: input.value });
        this.props.onChange(input.value);
    }

    render()
    {
        return <Select
            {...this.props}
            value={this.state.value}
            onChange={value => this.onChange(value, this.props.name)}
        />
    }
}

class CitySelect extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            selectedState: null,
            selectedCity: null,
            cityList: [],
            stateList: []
        };

        this.updateSelectedState = this.updateSelectedState.bind(this);
        this.selectCity = this.selectCity.bind(this);
    }

    updateSelectedState(item) 
    {
        if(!item) {
            this.setState({ selectedState: null, cityList: [] });
            return; // Fix bug on clear input.
        }

        fetcher.cachedGet(`/cidade/estado/${item.value}`)
        .then(response => {
            const cityList = response.data.map(item => ({ value: item.cidadeId, label: item.nome }))
            this.setState({ cityList: cityList })
        });

        this.setState({ selectedState: item.value });
    }

    selectCity(item)
    {
        if(!item) {
            this.setState({ selectedCity: null });
            return; // Fix bug on clear input.
        }

        this.setState({ selectedCity: item.value });
        this.props.onChange(({ cidadeId: item.value }));
    }

    render()
    {
        return <div className="ms-TextField-wrapper">
            <Label>{ this.props.label }</Label>
            <div className="Form-Select-City">
                <Async 
                    placeholder="UF"
                    searchable
                    style={{width: 100}}
                    value={ this.state.selectedState }
                    loadOptions={LoadStateList}
                    onChange={ this.updateSelectedState }
                />
                <Select
                    placeholder="Cidade"
                    searchable
                    value={ this.state.selectedCity }
                    disabled={ this.state.cityList.length===0 }
                    options={ this.state.cityList }
                    onChange={ this.selectCity }
                />
            </div>
        </div>;
    }
}

const LoadStateList = input => {
    return fetcher.cachedGet("/estado/all")
    .then(response => {
        const selectOptions = response.data.map( item => ({ value: item.estadoId, label: item.uf }) );
        return { options: selectOptions }
    });
}