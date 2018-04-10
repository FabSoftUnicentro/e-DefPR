import React, { Component } from "react";
import { Route } from "react-router-dom";
import { 
    Nav, 
    DefaultButton,
    Breadcrumb
} from "office-ui-fabric-react";

import OAuth from "../helpers/OAuth";
import Header from "./Header";
import Schedule from "./pages/Schedule";
import Employee from "./pages/Employee";
import EmployeeNew from "./pages/EmployeeNew";
import EmployeeView from "./pages/EmployeeView";
import Assist from "./pages/Assist";
import AssistCreate from "./pages/AssistCreate";

import "../styles/Dashboard.css"

class Dashboard extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            selectedKey: "/",
            authenticatedEmployee: null
        };
    }

    openNavLink(event, element)
    {
        if(element && this.props.history) {
            this.setState({ selectedKey: element.key });
            this.props.history.push(element.link);
        }
    }

    componentWillReceiveProps(nextProps) {
        this.setState({ selectedKey: nextProps.location.pathname });
    }

    componentDidMount()
    {
        this.setState({ selectedKey: window.location.pathname });

        OAuth.getEmployeeData()
        .then(result => {
            this.setState({ authenticatedEmployee: result });
        });
    }

    render()
    {
        const authAccount = this.state.authenticatedEmployee;
        const navMenuItems = authAccount ? authAccount.authorizedLinks : [];

        return <div className="dashboard">
            <Header account={ this.state.authenticatedEmployee } />
            
            <main>
                <div className="sidebar">
                    <div className="user-button">
                        <DefaultButton
                            primary
                            iconProps={{ iconName: 'CalendarAgenda' }} 
                        >
                            Agenda
                        </DefaultButton>
                    </div>
                    
                    <Nav 
                        groups={ [{ links: navMenuItems }] } 
                        selectedKey={this.state.selectedKey} 
                        onLinkClick={this.openNavLink.bind(this)} 
                    />
                </div>

                <div className="content">
                    <div className="main-header">
                        <Breadcrumb items={ [
                            { text: "Home", href: "/" },
                            { text: "Agenda" }
                        ] } />
                    </div>

                    <div className="main-page">
                        <Route exact path="/" component={Schedule} />
                        <Route exact path="/employee" component={Employee} />
                        <Route exact path="/employee/new" component={EmployeeNew} />
                        <Route exact path="/employee/v/:uid" component={EmployeeView} />
                        <Route exact path="/assist" component={Assist} />
                        <Route exact path="/assist/create" component={AssistCreate} user={this.state.authenticatedEmployee} />
                    </div>
                </div>
            </main>
        </div>;
    }
}

// const NavGroups =
// [
//     {
//         collapseByDefault: false,
//         forceAnchor: true,
//         links: [
//             { name: "Página inicial", link: "/", key: "/", isExpanded: true },
//             { name: "Triagem inicial", link: "/employee/new", key: "NewAssistido" },
//             { name: "Assistidos", link: "/", key: "t2" },
//             { name: "Processos", key: "t3" },
//             { name: "Registrar atividade", key: "t4" },
//             {
//                 name: 'Gerenciar Funcionários',
//                 url: "",
//                 links: [
//                     { name: "Consultar", link: "/employee", key: "/employee" },
//                     { name: "Cadastrar", link: "/employee/new", key: "/employee/new" },
//                     { name: "Últimas atividades", link: "/employee/new", key: "empActivities" }
//                 ],
//                 isExpanded: true
//             },
//             {
//                 name: 'Relatórios',
//                 url: "",
//                 links: [
//                     { name: "Test", key: "t1" },
//                     { name: "Test", key: "t2" },
//                     { name: "Test", key: "t3" },
//                     { name: "Test", key: "t4" },
//                     { name: "Test", key: "t5" }
//                 ],
//                 isExpanded: false
//             }
//         ]
//     }
// ];

export default Dashboard;