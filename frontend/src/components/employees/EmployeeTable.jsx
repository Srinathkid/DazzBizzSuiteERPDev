import React from "react";
import { Link } from "react-router-dom";
import employeeService from "../../services/employeeService";

const EmployeeTable =({employees,onDelete,deletingId})=>{
    
    return (
        <div className="card shadow-sm">
            <div className="card-body p-0">
                <div className="table-responsive">
                    <table className="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {employees.length === 0 ? (
                                <tr>
                                    <td>No employees found</td>
                                </tr>
                            ):(
                                employees.map((employee,index)=>(
                                    <tr key={employee.id}>
                                        <td>{index + 1} </td>
                                        <td>
                                            <strong>
                                                {employee.employee_code}
                                            </strong>
                                        </td>

                                        <td>
                                            {employee.first_name}{" "}
                                            {employee.last_name || ""}
                                        </td>
                                        <td>
                                            {employee.email || "-"}
                                        </td>
                                        <td>
                                            {employee.phone || "-"}
                                        </td>
                                        <td>
                                            {employee.department || "-"}
                                        </td>

                                        <td>
                                            {employee.designation || "-"}
                                        </td>

                                        
                                        
                                        <td>
                                            <span className={`badge ${employee.status==="active"?"bg-success":"bg-secondary"}`}>
                                                {employee.status}
                                            </span>
                                        </td>

                                        <td>
                                            <Link
                                            to={`/employees/${employee.id}`} 
                                            className="btn btn-sm btn-primary me-2">
                                                View
                                            </Link>
                                            <Link to={`/employees/${employee.id}/edit`} className="btn btn-sm btn-warning me-2">
                                            Edit
                                            </Link>
                                            <button type="button" className="btn btn-sm btn-danger"
                                            onClick={()=>onDelete(employee.id)}
                                            disabled={deletingId===employee.id}
                                            >
                                                {deletingId===employee.id?"Deleting...":"Delete"}
                                            </button>
                                        </td>

                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
};

export default EmployeeTable;