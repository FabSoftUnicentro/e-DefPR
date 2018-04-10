import Fetcher from "../helpers/Fetcher";

/**
 * Default services (aka C.R.U.D.)
 */
class Service
{
    /**
     * Create a new object
     * @param {service} route 
     * @param {form params} values 
     */
    create(route, values)
    {
        Fetcher.post(`/${route}/add`, values)
            .then(response => response.json())
            .then(response => console.log(result))
            .catch(error => console.error(error));
    }

    /**
     * List all objects. Can receive a list of filters fields
     * @param {service} route 
     * @param {array} fields 
     */
    index(route, fields)
    {

        Fetcher.get(`/${route}/query?fields=${fields.toString()}`)
            .then(result => result.json())
            .then(response => console.log(response))
            .catch(err => console.log(err));
    }

    /**
     * Get a single object.
     * @param {service} route 
     * @param {UUID} uid 
     */
    get(route, uid)
    {
        Fetcher.get(`/${route}/${uid}`)
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(err => console.log(err));
    }

    /**
     * Update a specific object
     * @param {service} route 
     * @param {UUID} uid 
     * @param {form params} values 
     */
    update(route, uid, values)
    {
        Fetcher.put(`/${route}/${uid}`, values)
            .then(response => response.json())
            .then(response => console.log(result))
            .catch(error => console.error(error));
    }

    /**
     * Destroy an object
     * @param {service} route 
     * @param {UUID} uid 
     */
    delete(route, uid)
    {
        Fetcher.delete(`/${route}/${uid}`)
            .then(response => response.json())
            .then(response => console.log(result))
            .catch(error => console.error(error));
    }
}


export default Service;