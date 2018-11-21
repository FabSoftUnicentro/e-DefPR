{!! form_start($form) !!}

<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Informações Pessoais</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    {!! form_label($form->name) !!}
                    {!! form_widget($form->name) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->cpf) !!}
                    {!! form_widget($form->cpf) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->email) !!}
                    {!! form_widget($form->email) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->password) !!}
                    {!! form_widget($form->password) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->birth_date) !!}
                    {!! form_widget($form->birth_date) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->rg) !!}
                    {!! form_widget($form->rg) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->rg_issuer) !!}
                    {!! form_widget($form->rg_issuer) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->gender) !!}
                    {!! form_widget($form->gender) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->marital_status) !!}
                    {!! form_widget($form->marital_status) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->note) !!}
                    {!! form_widget($form->note) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Endereço</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    {!! form_label($form->postcode) !!}
                    {!! form_widget($form->postcode) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->street) !!}
                    {!! form_widget($form->street) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->neighborhood) !!}
                    {!! form_widget($form->neighborhood) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->number) !!}
                    {!! form_widget($form->number) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->complement) !!}
                    {!! form_widget($form->complement) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->uf) !!}
                    {!! form_widget($form->uf) !!}
                </div>

                <div class="form-group">
                    {!! form_label($form->city) !!}
                    {!! form_widget($form->city) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-footer">
    {!! form_widget($form->submit) !!}
</div>
{!! form_end($form) !!}