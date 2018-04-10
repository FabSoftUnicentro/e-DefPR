import React, { Component } from "react";
import { CommandBar } from 'office-ui-fabric-react';

import Fetch from "../../helpers/Fetcher";

class EmployeeView extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            data: null
        };
    }

    componentDidMount()
    {
        Fetch.get(`/funcionario/fetch/${this.props.match.params.uid}`)
        .then(response => response.json())
        .then(result => this.setState({ data: result }))
        .catch(err => console.log(err));
    }

    render()
    {
        return <div className="page">
            <CommandBar
                farItems={[
                    { 
                        key: "headerBtRefresh", 
                        name: "Relatório", 
                        icon: "CRMReport"
                    }, { 
                        key: "headerBtNewEmployee", 
                        name: "Editar", 
                        icon: "Edit"
                    },
                ]}
            />

            { !this.state.data && <div>Loading...</div> }
            { this.state.data && <pre>{ JSON.stringify(this.state.data, null, 2) }</pre> }
        </div>;
    }
}

export default EmployeeView;