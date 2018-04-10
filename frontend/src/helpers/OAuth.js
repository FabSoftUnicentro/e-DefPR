import Fetcher, { ErrorMessage } from "../helpers/Fetcher";
import BuildEmployeeLinks from "./AuthLinks";

const OAuth = 
{
    /** PRIVATE */

    __isAuthenticated: false,

    __authSuccess(result)
    {
        sessionStorage.setItem("oauth_edefpr", window.btoa(JSON.stringify(result)));
        this.__isAuthenticated = true;
    },

    __getToken() {
        return JSON.parse(window.atob(sessionStorage.getItem("oauth_edefpr")))["access_token"];
    },

    /** PUBLIC */

    isAuthenticated()
    {
        if(sessionStorage.getItem("oauth_edefpr")) {
            this.__isAuthenticated = true;
        }

        return this.__isAuthenticated;
    },

    isTokenValid()
    {
        return new Promise((resolve, reject) => {
            Fetcher.post(`/check_token?token=${this.__getToken()}`, {}, "/oauth")
            .then(result => result.json())
            .then(response => {
                if(response.error) {
                    resolve("INVALID_TOKEN");
                    return;
                }

                resolve("OK");
            })
            .catch(err => console.log(err));
        });
    },

    getEmployeeData() {
        return new Promise((resolve, reject) => {
            Fetcher.get("/account", this.__getToken())
            .then(result => result.json())
            .then(response => {
                response.authorizedLinks = BuildEmployeeLinks(response.authorities);
                console.log(response);
                resolve(response)
            })
            .catch(err => {
                this.isTokenValid().then(response => {
                    this.logout();
                });
                reject(err)
            });
        });
    },

    logout()
    {
        this.__isAuthenticated = false;
        sessionStorage.clear();
        window.location.reload();
    },

    authenticate(username, password) 
    {
        return new Promise((resolve, reject) => 
        {
            Fetcher.authenticate(username, password)
            .then(result => {

                if(result.error) {
                    reject(ErrorMessage("Dados de acesso inválido(s)."));
                    return;
                }

                this.__authSuccess(result);
                resolve(result);
            })
            .catch(err => {
                console.error(err);
                reject(ErrorMessage("O servidor não está disponível."));
            });
        });
    }
};

export default OAuth;