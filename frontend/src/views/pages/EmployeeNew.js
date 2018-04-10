import React, { Component } from "react";
import { Form, Field } from "react-final-form";
import employeeService from "../../services/EmployeeService";

import FabricStepper from "../components/FabricStepper";
import { 
    TextFieldAdapter,
    CitySelectAdapter,
    DatePickerAdapter,
    GenderSelect,
    CivilStateSelect
} from "../components/Adapters";

class EmployeeNew extends Component
{
    onSubmit(values) {
        employeeService.create(values);
    }

    render()
    {
        return <div className="page">
            <Form
                onSubmit={this.onSubmit.bind(this)}
                render={({ handleSubmit, reset, submitting, pristine, values, meta }) => (
                    <div>
                        <FabricStepper 
                            onSubmit={handleSubmit} 
                            isSubmitting={submitting}
                        >
                            <FabricStepper.Step
                                title="Informações pessoais"
                            >
                                <div className="textfield-group">
                                    <Field name="nome" label="Nome" required={true} component={TextFieldAdapter} />
                                    <Field name="sobrenome" label="Sobrenome" required={true} component={TextFieldAdapter} />
                                </div>

                                <div className="textfield-group">
                                    <Field name="cpf" label="CPF" required={true} component={TextFieldAdapter} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="nascimento" label="Data de nascimento" component={DatePickerAdapter} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="rg" label="RG" required={true} component={TextFieldAdapter} />
                                    <Field name="orgaoEmissor" label="Orgão emissor" required={true} component={TextFieldAdapter} />
                                </div>

                                <div className="textfield-group">
                                    <Field name="genero" label="Genêro" searchable={false} component={GenderSelect} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="naturalidade" label="Cidade natal" component={CitySelectAdapter} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="estadoCivil" label="Estado civil" searchable={false} component={CivilStateSelect} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="profissao" label="Profissão" component={TextFieldAdapter} />
                                    <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="relatorio" label="Relatório" multiline component={TextFieldAdapter} />
                                </div>
                            </FabricStepper.Step>

                            <FabricStepper.Step
                                title="Endereços"
                            >
                                <div className="textfield-group">
                                    <Field name="enderecos[cep]" label="CEP" required={true} component={TextFieldAdapter} />
                                    <div /> <div />
                                </div>

                                <div className="textfield-group">
                                    <Field name="enderecos[rua]" label="Rua" required={true} component={TextFieldAdapter} />
                                    <Field name="enderecos[numero]" label="Número" required={true} component={TextFieldAdapter} />
                                </div>

                                <div className="textfield-group">
                                    <Field name="enderecos[cidade]" label="Cidade" required={true} component={CitySelectAdapter} />
                                    <Field name="enderecos[bairro]" label="Bairro" required={true} component={TextFieldAdapter} />
                                </div>

                                <div className="textfield-group">
                                    <Field name="enderecos[complemento]" label="Complemento" component={TextFieldAdapter} />
                                </div>
                            </FabricStepper.Step>

                            <FabricStepper.Step
                                title="Informações de acesso"
                            >
                                <div className="textfield-group">
                                    <Field name="email" label="E-mail" required={true} component={TextFieldAdapter} />
                                    <div /> <div />
                                </div>
                            </FabricStepper.Step>
                        </FabricStepper>
                    </div>
                )}
            />
        </div>;
    }
}

export default EmployeeNew;