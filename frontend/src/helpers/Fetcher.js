import OAuth from "./OAuth";

const Config = {
    baseUrl: "http://localhost:8080",
    webServiceUrl: `http://localhost:8080/api`,
    fetchOptions: {
        mode: "cors",
        headers: { 
            "Content-type": "application/json",
            "Authorization": `Basic ${window.btoa("def_guarapuava:fsunicentro")}`
        }
    }
};

const Fetcher =
{
    get: (service, token) =>
    {
        if(!token) {
            token = OAuth.__getToken();
        }

        return new Promise((resolve, reject) => 
        {
            if(!token || token==="") {
                reject({});
                return;
            }

            const hasParams = (service.indexOf("?")>0)?"&":"?";
            fetch(`${Config.webServiceUrl}${service}${hasParams}access_token=${token}`, { 
                method: "GET", 
                ...Config.fetchOptions
            })
            .then(result => resolve(result))
            .catch(error => {
                reject(error)
            });
        });
    },

    cachedGet: (service) =>
    {
        return new Promise((resolve, reject) => {

            let resourceFromCache = localStorage.getItem(service);
            if(resourceFromCache) {
                resolve(JSON.parse(resourceFromCache));
                return;
            }

            Fetcher.get(service)
                .then(result => result.json())
                .then(json => {
                    localStorage.setItem(service, JSON.stringify(json));
                    resolve(json);
                })
                .catch(error => reject(error));
        });
    },

    authenticate: (username, password) =>
    {
        const grantType = "password";

        return new Promise((resolve, reject) => {
            fetch(`${Config.baseUrl}/oauth/token?grant_type=${grantType}&username=${username}&password=${password}`, {
                method: "POST",
                mode: "cors",
                headers: {
                    "Authorization": `Basic ${window.btoa("def_guarapuava:fsunicentro")}`
                }
            })
            .then(result => result.json())
            .then(json => resolve(json))
            .catch(err => reject(err));
        });
    },

    post: (service, body, basePath = "/api") =>
    {

        let token = OAuth.__getToken();

        return new Promise((resolve, reject) => {
            fetch(`${Config.baseUrl}${basePath}${service}?access_token=${token}`, { 
                method: "POST", 
                ...Config.fetchOptions,
                body: JSON.stringify(body)
            })
            .then(result => resolve(result))
            .catch(error => reject(error));
        });
    }
}

export function ErrorMessage(message) {
    return {
        status: "unavaliable",
        message: message
    }
}

export default Fetcher;