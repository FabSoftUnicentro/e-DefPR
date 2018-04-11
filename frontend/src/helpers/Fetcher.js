import { API_URL, FETCH_OPTIONS } from './app.config';

/**
 * Default fetcher for all controllers.
 * Usage: fetcher.[METHOD](CONTROLLER_PATH, ...rest)
 */
const fetcher = 
{
    /**
     * Async getter from api.
     * @param {string | path} controllerPath 
     * Returns { status: HTTP_CODE, data: json }
     */
    async get(controllerPath = "/")
    {
        let response = await fetch(`${API_URL}${controllerPath}`, { method: 'GET', ...FETCH_OPTIONS });
        let data = await response.json();

        return { 
            status: response.status, 
            data: data
        };
    },

    /**
     * Async post to api.
     * @param {string | path} controllerPath 
     * @param {object} body 
     * Returns { status: HTTP_CODE, data: json }
     */
    async post(controllerPath = "/", body = {})
    {
        let response = await fetch(`${API_URL}${controllerPath}`, { 
            method: 'POST',
            body: JSON.stringify(body), 
            ...FETCH_OPTIONS 
        });

        let data = await response.json();

        return { 
            status: response.status, 
            data: data
        };
    },

    /**
     * Async put to api.
     * @param {string | path} controllerPath 
     * @param {object} body
     * Returns { status: HTTP_CODE, data: json } 
     */
    async put(controllerPath = "/", body = {})
    {
        let response = await fetch(`${API_URL}${controllerPath}`, { 
            method: 'PUT',
            body: JSON.stringify(body), 
            ...FETCH_OPTIONS 
        });

        let data = await response.json();

        return { 
            status: response.status, 
            data: data
        };
    },

    /**
     * Async delete from api.
     * @param {string | path} controllerPath
     * Returns { status: HTTP_CODE, data: json } 
     */
    async delete(controllerPath = "/")
    {
        let response = await fetch(`${API_URL}${controllerPath}`, { 
            method: 'DELETE',
            ...FETCH_OPTIONS 
        });

        let data = await response.json();

        return { 
            status: response.status, 
            data: data
        };
    }
};

export default fetcher;