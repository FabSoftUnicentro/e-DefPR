import Fetcher from "../helpers/Fetcher";

/**
 * Default services (aka C.R.U.D.)
 */
class Service
{
    /**
     * Route for the API's controller
     */
    route = undefined
    
    /**
     * Constructor. Can receive the route to API's controller
     * @param {string} route 
     */
    constructor(route = "/") {
        this.route = route;
    }

    /**
     * Create a new object
     * @param {form params} values 
     */
    create(values)
    {
        Fetcher.post(`${route}`, values)
            .then(response => response.json())
            .then(response => console.log(result))
            .catch(error => console.error(error));
    }

    /**
     * List all objects. Can receive a list of filters fields
     * @param {array} fields 
     */
    index(fields)
    {

        Fetcher.get(`${route}?fields=${fields.toString()}`)
            .then(result => result.json())
            .then(response => console.log(response))
            .catch(err => console.log(err));
    }

    /**
     * Get a single object.
     * @param {UUID} uid 
     */
    get(uid)
    {
        Fetcher.get(`${route}/${uid}`)
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(err => console.log(err));
    }

    /**
     * Update a specific object
     * @param {UUID} uid 
     * @param {form params} values 
     */
    update(uid, values)
    {
        Fetcher.put(`${route}/${uid}`, values)
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
        Fetcher.delete(`${route}/${uid}`)
            .then(response => response.json())
            .then(response => console.log(result))
            .catch(error => console.error(error));
    }
}


export default Service;