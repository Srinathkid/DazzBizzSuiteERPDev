import {Link, useParams} from 'react-router-dom';


function EmployeeView(){

    const {id}=useParams();

    const employee={
        id:id,
        employee_code: 'EMP001',
        first_name: 'Srinath',
        last_name: 'Selvaraj',
        email: 'srinath@dazz.com',
        phone: '9876543210',
        date_of_birth: '1992-11-04',
        gender: 'Male',
        date_of_joining: '2024-01-10',
        department: 'Technical',
        designation: 'Developer',
        manager: 'Manager Name',
        employment_type: 'Full Time',
        status: 'Active',
        address: '123 Main Street',
        city: 'Salem',
        state: 'Tamil Nadu',
        pincode: '636001',
        emergency_contact_name: 'Kumar',
        emergency_contact_phone: '9876500000',
    };

    return (
        <div>
        {/*Page Header*/}
            <div className="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 className="mb-1">
                        {employee.first_name}{employee.last_name}
                    </h2>

                    <p className="text-muted mb-0">
                        Employee Code:{employee.employee_code}
                    </p>
                </div>

                <div className="d-flex gap-2">
                    <Link
                    to={`/employees/${employee.id}/edit`}
                    className="btn btn-primary"
                    >
                        Edit
                    </Link>

                    <Link
                    to="/employees"
                    className="btn btn-secondary"
                    >
                        Back
                    </Link>
                </div>

            </div>

            {/* Basic Information */}
            <div className="card shadow-sm mb-4">

                <div className="card-header">
                    <strong>Basic Information</strong>
                </div>

                <div className="card-body">

                    <div className="row g-3">

                        <InfoItem
                            label="Employee Code"
                            value={employee.employee_code}
                        />

                        <InfoItem
                            label="First Name"
                            value={employee.first_name}
                        />

                        <InfoItem
                            label="Last Name"
                            value={employee.last_name}
                        />

                        <InfoItem
                            label="Email"
                            value={employee.email}
                        />

                        <InfoItem
                            label="Phone"
                            value={employee.phone}
                        />

                        <InfoItem
                            label="Date of Birth"
                            value={employee.date_of_birth}
                        />

                        <InfoItem
                            label="Gender"
                            value={employee.gender}
                        />

                        <InfoItem
                            label="Date of Joining"
                            value={employee.date_of_joining}
                        />

                    </div>

                </div>

            </div>
        {/* Employment Information */}
            <div className="card shadow-sm mb-4">

                <div className="card-header">
                    <strong>Employment Information</strong>
                </div>

                <div className="card-body">

                    <div className="row g-3">

                        <InfoItem
                            label="Department"
                            value={employee.department}
                        />

                        <InfoItem
                            label="Designation"
                            value={employee.designation}
                        />

                        <InfoItem
                            label="Manager"
                            value={employee.manager}
                        />

                        <InfoItem
                            label="Employment Type"
                            value={employee.employment_type}
                        />

                        <div className="col-md-6">
                            <label className="text-muted small">
                                Status
                            </label>

                            <div>
                                <span className="badge bg-success">
                                    {employee.status}
                                </span>
                            </div>
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

                        <InfoItem
                            label="Address"
                            value={employee.address}
                            fullWidth
                        />

                        <InfoItem
                            label="City"
                            value={employee.city}
                        />

                        <InfoItem
                            label="State"
                            value={employee.state}
                        />

                        <InfoItem
                            label="Pincode"
                            value={employee.pincode}
                        />

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

                        <InfoItem
                            label="Contact Name"
                            value={employee.emergency_contact_name}
                        />

                        <InfoItem
                            label="Contact Phone"
                            value={employee.emergency_contact_phone}
                        />

                    </div>

                </div>

            </div>

        </div>
    );
}

function InfoItem({ label, value, fullWidth = false }) {
    return (
        <div className={fullWidth ? 'col-12' : 'col-md-6'}>
            <label className="text-muted small">
                {label}
            </label>

            <div className="fw-semibold">
                {value || '-'}
            </div>
        </div>
    );
}
export default EmployeeView;