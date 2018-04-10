import React, { Component } from "react";
import { Redirect } from "react-router-dom";
import { 
    TextField, 
    DefaultButton, 
    Link, 
    IconButton, 
    Label,
    TeachingBubble,
    Spinner,
    MessageBar, MessageBarType
} from 'office-ui-fabric-react';

import "../styles/SignIn.css";

class SignIn extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            messageBarProps: null,
            isLoading: false,
            redirectToReferrer: false,
            showHelpBubble: false,
            showBackButton: false, 
            component: null,
            form: {}
        };

        this.openRecoveryPassword = this.openRecoveryPassword.bind(this);
        this.onHeaderBtClick = this.onHeaderBtClick.bind(this);
        this.toggleHelpBubble = this.toggleHelpBubble.bind(this);
        this.onSignIn = this.onSignIn.bind(this);
        this.onTextfieldChange = this.onTextfieldChange.bind(this);
    }

    onTextfieldChange(name, value) 
    {
        let { form } = this.state;
        form[name] = value;

        this.setState({ form: form });
    }

    componentDidMount() {
        this.home();
    }

    openRecoveryPassword()
    {
        this.setState({
            showBackButton: true,
            component: <RecoveryPassword />
        });
    }

    onHeaderBtClick()
    {
        if(this.state.showBackButton) {
            this.home();
        }
    }

    home()
    {
        this.setState({
            showBackButton: false,
            component: <SignInForm 
                            recovery={this.openRecoveryPassword}
                            signin={this.onSignIn}
                            onChange={this.onTextfieldChange}
                        />
        });
    }

    toggleHelpBubble() {
        this.setState((prevState) => ({ showHelpBubble: !prevState.showHelpBubble }));
    }

    onSignIn() 
    {
        this.setState({ isLoading: true, messageBarProps: null });
        this.props.oauth.authenticate(this.state.form.username, this.state.form.password)
        .then(result => this.setState({ 
            redirectToReferrer: true,
            messageBarProps: { 
                type: MessageBarType.success, 
                text: "Você entrou. Vamos levar você até o sistema." 
            }
        }))
        .catch(err => this.setState({
            isLoading: false,
            messageBarProps: { 
                type: MessageBarType.severeWarning, 
                text: err.message 
            }
        }));
    }

    render()
    {
        if(this.state.redirectToReferrer) {
            return <Redirect to="/" />;
        }

        const examplePrimaryButton = {
            children: 'Wiki'
        };

        const exampleSecondaryButtonProps = {
            children: 'Desenvolvedores'
        };

        const { 
            messageBarProps,
            isLoading,
            showBackButton
        } = this.state;

        return <div className="login">
            <div className="login-box">
                <div className="login-header">
                    <div>
                        <IconButton 
                            iconProps={{ iconName: showBackButton?'Back':'SecurityGroup' }} 
                            title="Voltar" 
                            ariaLabel='Emoji'
                            onClick={this.onHeaderBtClick}
                        />
                        <span>eDef-PR</span>
                    </div>
                    { isLoading && <Spinner /> }
                </div>

                { messageBarProps && <MessageBar messageBarType={messageBarProps.type}>
                    {messageBarProps.text}
                </MessageBar> }
                
                { (!messageBarProps || messageBarProps.type!==MessageBarType.success) 
                    && this.state.component }

                <div className="login-footer">
                    <span ref={lk => { this._linkHelp = lk; }}>
                        <Link onClick={this.toggleHelpBubble}>Ajuda</Link>
                    </span>
                    { this.state.showHelpBubble && <TeachingBubble
                        targetElement={ this._linkHelp }
                        headline="Ajuda"
                        hasCloseIcon
                        hasSmallHeadline
                        primaryButtonProps={ examplePrimaryButton }
                        secondaryButtonProps={ exampleSecondaryButtonProps }
                        onDismiss={this.toggleHelpBubble}
                    >
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Facere, nulla, ipsum? Molestiae quis aliquam magni harum non?
                    </TeachingBubble> }
                </div> 
            </div>
        </div>;
    }
}

const RecoveryPassword = props => (
    <div>
        <Label>Se o cpf estiver cadastrado você reberá um e-mail com 
        instruções para recurar sua senha.</Label>
        <TextField label="CPF" />

        <div className="login-action">
            <div />
            <DefaultButton primary text="Recuperar" />
        </div>
    </div>
);

const SignInForm = props => (
    <div>
        <TextField label="CPF" onChanged={val => props.onChange("username", val)} />
        <TextField type="password" label="Senha" onChanged={val => props.onChange("password", val)} />
        
        <div className="login-action">
            <Link onClick={props.recovery}>Esqueci minha senha</Link>
            <DefaultButton primary text="Acessar" onClick={props.signin} />
        </div>
    </div>
);

export default SignIn;