import api from './api';

const authService={

    login:async(username,password)=>{

        //Get CSRF Token
        await api.get('/sanctum/csrf-cookie');

        //Login
        const response=await api.post('/api/v1/login',{
            username,password,
        });

        return response.data;
    },


    me:async()=>{
        const response=await api.get('/api/v1/me');
        return response.data;
    },

    logout:async()=>{
        const response=await api.post('/api/v1/logout');
        return response.data;
    },

    

};

export default authService;