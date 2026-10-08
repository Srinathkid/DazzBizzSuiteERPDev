import {useEffect,useState} from 'react';
import employeeService from '../../services/employeeService';
import {useNavigate, useParams} from 'react-router-dom';
import FieldError from '../../components/common/FieldError';

function EmployeeForm(){
    const [formData,setFormData]=useState({
        employee_code:'',
        first_name:'',
        last_name:'',
        email: '',
        phone: '',
        date_of_birth: '',
        gender: '',
        date_of_joining: '',
        department_id: '',
        designation_id: '',
        manager_id: '',
        employment_type: 'full_time',
        status: 'active',
        address: '',
        city: '',
        state: '',
        pincode: '',
        emergency_contact_name: '',
        emergency_contact_phone: '',
    });

    const {id}=useParams();
    const isEditMode=Boolean(id);

    const [loading,setLoading]=useState(false);
    const [error,setError]=useState('');
    const [loadingEmployee,setLoadingEmployee]=useState(false);
    const [validationErrors,setValidationErrors]=useState({});

    const navigate=useNavigate();

    const handleChange=(e)=>{
        const {name,value}=e.target;

        setFormData((previous)=>({
            ...previous,
            [name]:value,
        }));
    };

    const handleSubmit=async(event)=>{
        event.preventDefault();
        
        setError('');
        setValidationErrors({});
        setLoading(true);

        try{
            if(isEditMode){
                await employeeService.update(id, formData);
                alert('Employee updated successfully!');
            }else{
                await employeeService.create(formData);
                alert('Employee created successfully!');
            }
           
            navigate('/employees');
        }catch(error){
            console.error('Error creating employee:', error);

            if(error.response?.status === 422){
                setValidationErrors(error.response.data.errors || {});
                setError(error.response.data.message || 'Please correct the validation errors.');
            }else{
                setError(error.response?.data?.message || 'Failed to save employee.');
            }
            
        }finally{
            setLoading(false);
        }
    };

    useEffect(()=>{
        if(!isEditMode){
            return;
        }
        const loadEmployee=async()=>{
            try{
                setLoadingEmployee(true);
                setError('');

                const response=await employeeService.getById(id);
                const employee=response.data.employee;
                setFormData({
                employee_code: employee.employee_code || '',
                first_name: employee.first_name || '',
                last_name: employee.last_name || '',
                email: employee.email || '',
                phone: employee.phone || '',
                date_of_birth: employee.date_of_birth || '',
                gender: employee.gender || '',
                date_of_joining: employee.date_of_joining || '',
                department_id: employee.department_id || '',
                designation_id: employee.designation_id || '',
                manager_id: employee.manager_id || '',
                employment_type: employee.employment_type || '',
                status: employee.status || '',
                address: employee.address || '',
                city: employee.city || '',
                state: employee.state || '',
                pincode: employee.pincode || '',
                emergency_contact_name:
                    employee.emergency_contact_name || '',
                emergency_contact_phone:
                    employee.emergency_contact_phone || '',
            });
            }catch(error){
                console.error('Error loading employee:', error);

                setError(
                    error.response?.data?.message || 'Failed to load employee data.'
                );
            }finally{
                setLoadingEmployee(false);
            }
        };
        loadEmployee();
    },[id,isEditMode]);
    return(
        <div>
            {/*Page Header*/}
            <div className="mb-4">
                <h2 className="mb-1">{isEditMode ? 'Edit Employee' : 'Add Employee'}</h2>
                <p className="text-muted mb-0">{isEditMode ? 'Update employee information' : 'Create a new employee'}</p>
            </div>
{error && (<div className="alert alert-danger">{error}</div>)}
            <form onSubmit={handleSubmit}>

                {/* Basic Information */}
                <div className="card shadow-sm mb-4">
                    <div className="card-header">
                        <strong>Basic Information</strong>
                    </div>

                    <div className="card-body">
                        <div className="row g-3">
                            <div className="col-md-4">
                                <label className="form-label">
                                    Employee Code *
                                </label>

                                <input
                                    type="text"
                                    name="employee_code"
                                    className={`form-control ${validationErrors.employee_code ? 'is-invalid':''}`}
                                    value={formData.employee_code}
                                    onChange={handleChange}
                                    required
                                />
                                <FieldError errors={validationErrors}
                                field="employee_code" />

                            </div>
                            <div className="col-md-4">
                                <label className="form-label">
                                    First Name *
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    className={`form-control ${validationErrors.first_name ? 'is-invalid':''}`}
                                    value={formData.first_name}
                                    onChange={handleChange}
                                    required
                                />
                                  <FieldError errors={validationErrors}
                                    field="first_name" />
                            </div>

                           <div className="col-md-4">
                                <label className="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    className={`form-control ${validationErrors.last_name ? 'is-invalid':''}`}
                                    value={formData.last_name}
                                    onChange={handleChange}
                                />
                                <FieldError errors={validationErrors}
                                    field="last_name" />
                            </div>

                            <div className="col-md-6">
                                <label className="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    className={`form-control ${validationErrors.email ? 'is-invalid':''}`}
                                    value={formData.email}
                                    onChange={handleChange}
                                />

                                <FieldError errors={validationErrors}
                                field="email" />
                            </div>

                            <div className="col-md-6">
                                <label className="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    className={`form-control ${validationErrors.phone ? 'is-invalid':''}`}
                                    value={formData.phone}
                                    onChange={handleChange}
                                />
                                <FieldError errors={validationErrors}
                                field="phone" />
                            </div>

                           <div className="col-md-4">
                                <label className="form-label">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="date_of_birth"
                                    className="form-control"
                                    value={formData.date_of_birth}
                                    onChange={handleChange}
                                />
                            </div>

                           <div className="col-md-4">
                                <label className="form-label">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    className="form-select"
                                    value={formData.gender}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                             <div className="col-md-4">
                                <label className="form-label">
                                    Date of Joining *
                                </label>

                                <input
                                    type="date"
                                    name="date_of_joining"
                                    className={`form-control ${validationErrors.date_of_joining ? 'is-invalid':''}`}
                                    value={formData.date_of_joining}
                                    onChange={handleChange}
                                    required
                                />
                                <FieldError errors={validationErrors}   
                                field="date_of_joining" />
                            </div>

                        </div>
                    </div>
                </div>

                {/* Employee Information */}
                <div className="card shadow-sm mb-4">
                    <div className="card-header">
                        <strong>Employee Information</strong>
                    </div>

                    <div className="card-body">
                        <div className="row g-3">
                            <div className="col-md-4">
                                <label className="form-label">
                                    Derpartment
                                </label>

                                <select
                                    name="department_id"
                                    className="form-select"
                                    value={formData.department_id}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Department</option>
                                    <option value="1">Administration</option>
                                    <option value="2">Sales</option>
                                    <option value="3">Technical</option>
                                </select>
                            </div>

                            <div className="col-md-4">
                                <label className="form-label">
                                    Designation
                                </label>

                                <select
                                name="designation_id"
                                className="form-select"
                                value={formData.designation_id}
                                onChange={handleChange}>
                                    <option value="">Select Designation</option>
                                    <option value="1">Manager</option>
                                    <option value="2">Developer</option>
                                    <option value="3">Executive</option>
                                </select>
                            </div>

                            <div className="col-md-4">
                                <label className="form-label">
                                    Manager
                                </label>

                                <select
                                    name="manager_id"
                                    className="form-select"
                                    value={formData.manager_id}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Manager</option>
                                    <option value="1">EMP001 - Arun Kumar</option>
                                    <option value="2">EMP002 - Priya Raj</option>
                                </select>
                            </div>

                            <div className="col-md-6">
                                <label className="form-label">
                                    Employment Type *
                                </label>

                                <select
                                name="employment_type"
                                className="form-select"
                                value={formData.employment_type}
                                onChange={handleChange}
                                required>
                                    <option value="full_time">Full Time</option>
                                    <option value="part_time">Part Time</option>
                                    <option value="contract">Contract</option>
                                </select>   
                            </div>

                            <div className="col-md-6">
                                <label className="form-label">
                                    Status *
                                </label>    
                                <select
                                name="status"
                                className="form-select"
                                value={formData.status}
                                onChange={handleChange}
                                required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="resigned">Resigned</option>
                                    <option value="terminated">Terminated</option>
                                    <option value="suspended">Suspended</option>
                                    <option value="on_leave">On Leave</option>
                                    <option value="on_probation">On Probation</option>
                                    <option value="on_training">On Training</option>
                                </select>   
                            </div>


                        </div>
                    </div>
                </div>

            {/* Address */}
                <div className="card shadow-sm mb-4">
                    <div className="card-header">
                        <strong>Address</strong>
                    </div>

                    <div className="card-body">
                        <div className="row g-3">

                            <div className="col-12">
                                <label className="form-label">
                                    Address
                                </label>

                                <textarea
                                    name="address"
                                    className="form-control"
                                    rows="3"
                                    value={formData.address}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="col-md-4">
                                <label className="form-label">
                                    City
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    className="form-control"
                                    value={formData.city}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="col-md-4">
                                <label className="form-label">
                                    State
                                </label>

                                <input
                                    type="text"
                                    name="state"
                                    className="form-control"
                                    value={formData.state}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="col-md-4">
                                <label className="form-label">
                                    Pincode
                                </label>

                                <input
                                    type="text"
                                    name="pincode"
                                    className="form-control"
                                    value={formData.pincode}
                                    onChange={handleChange}
                                />
                            </div>

                        </div>
                    </div>
                </div>

                {/* Emergency Contact */}
                <div className="card shadow-sm mb-4">
                    <div className="card-header">
                        <strong>Emergency Contact</strong>
                    </div>

                    <div className="card-body">
                        <div className="row g-3">

                            <div className="col-md-6">
                                <label className="form-label">
                                    Contact Name
                                </label>

                                <input
                                    type="text"
                                    name="emergency_contact_name"
                                    className="form-control"
                                    value={formData.emergency_contact_name}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="col-md-6">
                                <label className="form-label">
                                    Contact Phone
                                </label>

                                <input
                                    type="text"
                                    name="emergency_contact_phone"
                                    className="form-control"
                                    value={formData.emergency_contact_phone}
                                    onChange={handleChange}
                                />
                            </div>

                        </div>
                    </div>
                </div>

                {/* Buttons */}
                <div className="d-flex gap-2 mb-4">
                    <button type="submit" className="btn btn-primary" disabled={loading}>
                        {loading ? 'Saving...' : isEditMode ? 'Update Employee' : 'Save Employee'}
                    </button>

                    <button type="button" className="btn btn-secondary"
                    onClick={()=>window.history.back()}>
                        Cancel
                    </button>
                </div>

            </form>
        </div>
    );
}

export default EmployeeForm;