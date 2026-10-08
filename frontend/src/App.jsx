
import {Link, Route, Routes, useLocation} from 'react-router-dom';
import EmployeeList from './pages/employees/EmployeeList';
import EmployeeForm from './pages/employees/EmployeeForm';
import EmployeeView from './pages/employees/EmployeeView';
import Login from './pages/Login';
import ERPLayout from './layouts/ERPLayout';
import ProtectedRoute from './components/ProtectedRoute';

function Dashboard(){
  return(
    <div className="container-fluid">
      <h2>Dashboard</h2>
      <p>Welcome to DazzBizzSuite ERP!</p>
    </div>
  );
}

function Employees(){
  return(
    <div className="container-fluid">
      <h2>Employees</h2>
      <p>Employee Module coming next.</p>
    </div>
  );
}

function App(){
  
  return (
          <Routes>
            <Route path="/login" element={<Login />}/>

            <Route element={<ProtectedRoute/>}>
              <Route element={<ERPLayout />}>
                <Route path="/" element={<Dashboard />} />
                <Route path="/employees" element={<EmployeeList />} />
                <Route path="/employees/create" element={<EmployeeForm />} />
                <Route path="/employees/:id/edit" element={<EmployeeForm />} />
                <Route path="/employees/:id" element={<EmployeeView/>}/>
              </Route>
            </Route>
          </Routes>
     
  );

}
export default App;
