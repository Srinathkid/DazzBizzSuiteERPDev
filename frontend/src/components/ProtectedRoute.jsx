import {Navigate, Outlet} from 'react-router-dom';
import {useAuth} from '../context/AuthContext';

function ProtectedRoute(){
    const {user, loading}=useAuth();

    if(loading){
        return (
            <div className='min-vh-100 d-flex justify-content-center align-items-center'>
                <div>Loading...</div>
            </div>
        );
    }

    if(!user){
        return <Navigate to="/login" replace/>;
    }
    
    return <Outlet />
}



export default ProtectedRoute;