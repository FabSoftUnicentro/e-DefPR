import fetcher from "../helpers/fetcher";

class EmployeeService
{
    /**
     * Create new employee.
     * @param {form params} values 
     */
    create(values)
    {
        // TODO: Add validators.
        // TODO: Return results.
        values.enderecos = [values.enderecos];
        fetcher.post("/funcionario/add", values)
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(error => console.error(error));
    }

    list()
    {
        fetcher.get("/funcionario/query?fields=pessoaId,nomeCompleto,cpf,email")
            .then(result => result.json())
            .then(response => console.log(response))
            .catch(err => console.log(err));
    }

    get(uid)
    {
        // TODO: Return results.
        fetcher.get(`/funcionario/fetch/${uid}`)
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(err => console.log(err));
    }
}

export default (new EmployeeService());