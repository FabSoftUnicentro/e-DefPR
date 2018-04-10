import React, { Component } from "react";
import { 
    Persona, 
    PersonaSize, 
    IconButton,
    Panel,
    Link
} from "office-ui-fabric-react";

import "../styles/Header.css";

class Header extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            accountMenuIsOpen: false,
            userAccount: null
        };

        this.toggleAccountMenu = this.toggleAccountMenu.bind(this);
        this.closeAccountMenu = this.closeAccountMenu.bind(this);
    }

    componentWillReceiveProps(nextProps)
    {
        if(nextProps.account) {
            this.setState({ userAccount: nextProps.account });
        }
    }

    toggleAccountMenu() {
        this.setState( (prevState) => ({ accountMenuIsOpen: !prevState.accountMenuIsOpen }) );
    }

    closeAccountMenu() {
        this.setState({ accountMenuIsOpen: false });
    }

    render()
    {
        const { userAccount } = this.state;

        return <header className="header">

            <div />

            <div className="header-account">

                <IconButton
                    iconProps={{ iconName: "ChatInviteFriend" }}
                    title="Notificações"
                />

                { userAccount && <Persona 
                        className="ms-Custom-Persona"
                        primaryText={userAccount.displayName} 
                        size={ PersonaSize.size32 }
                        onClick={this.toggleAccountMenu}
                /> }

                <Panel 
                    isOpen={this.state.accountMenuIsOpen}
                    isBlocking={false}
                    headerText='Minha conta'
                    className="ms-Account-Panel"
                    isLightDismiss={true}
                    onDismissed={this.closeAccountMenu}
                >
                    <p>{ userAccount && userAccount.nomeCompleto }</p><br /><br />
                    <Link>Editar dados</Link><br /><br />
                    { userAccount && <Link to={`/employee/v/${userAccount.pessoaId}`}>Ver meus dados</Link> } 
                    <br /><br />
                    <Link>Sair</Link>
                </Panel>
            </div>

            
            
        </header>;
    }
}

export default Header;