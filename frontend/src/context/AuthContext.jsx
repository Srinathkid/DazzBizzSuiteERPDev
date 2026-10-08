import { createContext, useContext, useEffect, useState } from "react";
import authService from "../services/authService";

const AuthContext = createContext(null);

export function AuthProvider({children}){
    const [user,setUser]=useState(null);
    const [loading, setLoading]=useState(true);

    const loadUser = async()=>{
        try{
            const response = await authService.me();
            setUser(response.data.user);
        }catch(error){
            console.error('Auth check failed:', error);
            setUser(null);
        }finally{
            setLoading(false);
        }
    };

    useEffect(()=>{
        loadUser();
    },[]);

    const login = async(username, password)=>{
        const response = await authService.login(username,password);
        setUser(response.data.user);
        return response;
    };

    const logout = async()=>{
        await authService.logout();
        setUser(null);
    };

    return(
        <AuthContext.Provider
            value={{
                user,
                loading,
                login,
                logout,
            }}
        >
            {children}
        </AuthContext.Provider>
    );
}

export function useAuth(){
    return useContext(AuthContext);
}