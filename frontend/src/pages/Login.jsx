import { useState } from "react";
import {useNavigate} from "react-router-dom";
import {useAuth}from '../context/AuthContext';
import 'bootstrap-icons/font/bootstrap-icons.css';

function Login(){

    const navigate = useNavigate();
    const {login} = useAuth();
    const [username, setUsername]=useState('');
    const [password, setPassword]=useState('');

    const [loading, setLoading]=useState(false);
    const [error, setError]=useState('');

    const [showPassword, setShowPassword]=useState(false);

    const handleSubmit = async(event)=>{
        event.preventDefault();

        setError('');
        setLoading(true);

        try{
            await login(username,password);
            navigate('/employees');
        }catch(error){
            console.error(error);

            setError(
                error.response?.data?.message ||
                'Login failed. Please check your username and password.'
            );
        }finally{
            setLoading(false);
        }
    };

    return(
        <div className="container-fluid min-vh-100 d-flex justify-content-center align-items-center bg-light">
            <div className="card shadow-sm" style={{width:'400px'}}>
                <div className="card-body p-4">
                    <h3 className="text-center mb-4">DazzBizzSuite ERP</h3>
                    <h5 className="text-center mb-4">Login</h5>

                    {error && (
                        <div className="alert alert-danger">
                            {error}
                        </div>
                    )}

                    <form onSubmit={handleSubmit}>
                        <div className="mb-3">
                            <label className="for-label">
                                Username
                            </label>

                            <input 
                                type="text"
                                className="form-control"
                                value={username}
                                onChange={(event)=>setUsername(event.target.value)}
                                required
                            />
                        </div>

                        <div className="mb-3">
                            <label className="form-label">Password</label>
                        <div className="input-group">
                            <input 
                                type={showPassword?'text':'password'}
                                className="form-control"
                                value={password}
                                onChange={(event)=>setPassword(event.target.value)}
                                required
                            />
                            <button
                                type="button"
                                className="btn btn-outline-secondary"
                                onClick={()=>setShowPassword(!showPassword)}
                            >
                                {/*{showPassword?'Hide':'Show'}*/}
                                <i className={showPassword ? "bi bi-eye-slash" : "bi bi-eye"}></i>
                            </button>
                            </div>
                        </div>

                        <button 
                            type="submit"
                            className="btn btn-primary w-100"
                            disabled={loading}
                        >
                            {loading?'Logging in...':'Login'}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login;
