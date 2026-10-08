import { Link, Outlet, useNavigate } from 'react-router-dom';
import {useAuth} from '../context/AuthContext';

function ERPLayout() {
    const {user,logout}=useAuth();
    const navigate=useNavigate();
    const handleLogout = async() =>{
        try{
            await logout();
            navigate('/login',{replace:true});
        }catch(error){
            console.error('Logout failed : ',error);
        }
    };
    return (
        <div className="d-flex min-vh-100">

            {/* Sidebar */}
            <aside
                className="bg-dark text-white p-3"
                style={{
                    width: '220px',
                    flexShrink: 0,
                   
                }}
            >
                <h4 className="mb-4">
                    DazzBizz ERP
                </h4>

                <nav className="nav flex-column gap-2">

                    <Link
                        to="/"
                        className="nav-link text-white"
                    >
                        Dashboard
                    </Link>

                    <Link
                        to="/employees"
                        className="nav-link text-white"
                    >
                        Employees
                    </Link>

                </nav>
            </aside>

            {/* Main Content */}
            <main className="flex-grow-1 bg-light">

                {/* Header */}
                <header className="bg-white border-bottom p-3">
                    <div className='d-flex justify-content-between align-items-center'>
                    <h5 className="mb-0">
                        ERP Management System
                    </h5>

                    <div className='d-flex align-items-center gap-3'>
                        <span className='text-muted'>
                            {user?.name || user?.username || 'User'}
                        </span>

                        <button 
                        type='button'
                        className='btn btn-outline-danger btn-sm'
                        onClick={handleLogout}
                        >
                            Logout
                        </button>
                    </div>
                    </div>
                </header>

                {/* Page */}
                <div className="p-4">
                    <Outlet />
                </div>

            </main>

        </div>
    );
}

export default ERPLayout;