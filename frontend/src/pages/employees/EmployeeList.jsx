import { useEffect, useState } from 'react';
import EmployeeTable from "../../components/employees/EmployeeTable";
import { Link } from 'react-router-dom';
import employeeService from '../../services/employeeService';

function EmployeeList() {
    const [employees, setEmployees] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');
    const [search, setSearch] = useState('');

    const [deletingId, setDeletingId] = useState(null);

    const [pagination, setPagination] = useState({
        current_page: 1,
        per_page: 20,
        total: 0,
        last_page: 1,
    });


    const handleDelete = async (id) => {
        const confirmed = window.confirm("Are you sure you want to delete this employee>?");
        if (!confirmed) {
            return;
        }

        try {
            setDeletingId(id);
            setError('');

            await employeeService.delete(id);

            //Remove the deleted employee from the list
            setEmployees((currentEmployees) => currentEmployees.filter((employee) => employee.id !== id));

        } catch (error) {
            console.error(error);

            setError(error.response?.data?.message || 'Failed to delete employee.');
        } finally {
            setDeletingId(null);
        }
    };

    const loadEmployees = async (page = 1, searchValue = search) => {
        try {
            setLoading(true);
            setError('');

            const response = await employeeService.getAll({
                page,
                per_page: 2,
                search: searchValue,
            });
            setEmployees(response.data.employees);
            setPagination(response.data.pagination);
        } catch (error) {
            console.error(error);

            setError(error.response?.data?.message ||
                'Failed to load employees.'
            );
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        loadEmployees();
    }, []);

    const getPageNumbers = () => {
        const currentPage = pagination.current_page;
        const lastPage = pagination.last_page;

        const pages = [];

        if (lastPage <= 7) {
            for (let page = 1; page <= lastPage; page++) {
                pages.push(page);
            }
            return pages;
        }

        pages.push(1);

        if (currentPage > 2) {
            pages.push('...');
        }
        pages.push(lastPage);
        return pages;
    }
    
    const firstItem=pagination.total===0?0:(pagination.current_page-1)*pagination.per_page+1;
    const lastItem=Math.min(pagination.current_page*pagination.per_page,pagination.total);
    return (
        <div >
            {/*Page Heaader*/}
            <div className="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 className="mb-1">Employees</h3>

                </div>

                <Link to="/employees/create" className="btn btn-primary">
                    + Add Employee
                </Link>
            </div>

            {/* Error */}
            {error && (
                <div className='alert alert-danger'>
                    {error}
                </div>
            )}
            {/*Search*/}
            <div className="card shadow-sm mb-4">
                <div className="card-body">

                    <div className="row align-items-center mb-3">
                        <div className="col-md-8">
                            <label className="form-label fw-semibold">
                                Search Employees
                            </label>

                            <div className="input-group">
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Search employees..."
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                    onKeyDown={(e) => {
                                        if (e.key === 'Enter') {
                                            loadEmployees(1);
                                        }
                                    }}
                                />
                                <button
                                    type="button"
                                    className="btn btn-primary"
                                    onClick={() => loadEmployees(1)}
                                >
                                    Search
                                </button>
                                {search && (
                                    <button
                                        type="button"
                                        className="btn btn-secondary"
                                        onClick={() => {
                                            setSearch('');
                                            loadEmployees(1, '');
                                        }}
                                    >
                                        Clear
                                    </button>
                                )

                                }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <p className="text-muted mb-0">Manage your employees. {pagination.total} total</p>
                </div>
            </div>
            {/*Employee Table*/}
            <div className='card shadow-sm'>
                <div className='card-body'>

                    {loading ? (

                        < div className="d-flex justify-content-center align-items-center py-5">
                            <div className="spinner-border text-primary" role="status">
                                <span className="visually-hidden">
                                    Loading...
                                </span>
                            </div>
                        </div>
                    ) : employees.length === 0 ? (
                        <div className='text-center py-4 text-muted'>
                            <h5 className="mb-2">No employees found</h5>

                            <p className="text-muted mb-3">
                                {search
                                    ? 'No employees match your search.'
                                    : 'There are no employees available.'}
                            </p>

                            {search && (
                                <button
                                    type="button"
                                    className="btn btn-outline-primary"
                                    onClick={() => {
                                        setSearch('');
                                        loadEmployees(1, '');
                                    }}
                                >
                                    Clear Search
                                </button>
                            )}
                        </div>
                    ) : (
                        <EmployeeTable
                            employees={employees}
                            onDelete={handleDelete}
                            deletingId={deletingId}
                        />


                    )}
                    {pagination.last_page > 1 && (
                        <div className='d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-3'>
                            <div className="text-muted">
                                Showing {firstItem} to {lastItem} of {pagination.total} employees
                            </div>

                            <div className="btn-group">
                                {/* First Button */}
                                <button
                                    type="button"
                                    className="btn btn-outline-primary"
                                    disabled={pagination.current_page === 1}
                                    onClick={() => loadEmployees(1)}
                                >
                                    First
                                </button>
                                {/* Previous Button */}
                                <button
                                    type="button"
                                    className="btn btn-outline-primary"
                                    disabled={pagination.current_page === 1}
                                    onClick={() =>
                                        loadEmployees(pagination.current_page - 1)
                                    }
                                >
                                    Previous
                                </button>

                                {/* Page Numbers */}
                                {getPageNumbers().map((page, index) => page === '...' ? (
                                    <button
                                        key={`ellipsis-${index}`}
                                        type="button"
                                        className="btn btn-outline-secondary"
                                        disabled
                                    >
                                        ...
                                    </button>
                                ) : (
                                    <button
                                        key={page}
                                        type="button"
                                        className={
                                            page === pagination.current_page
                                                ? 'btn btn-primary'
                                                : 'btn btn-outline-primary'
                                        }
                                        onClick={() => loadEmployees(page)}
                                    >
                                        {page}
                                    </button>
                                )
                                )}
                                {/* Next Button */}
                                <button
                                    type="button"
                                    className="btn btn-outline-primary"
                                    disabled={pagination.current_page === pagination.last_page}
                                    onClick={() =>
                                        loadEmployees(pagination.current_page + 1)
                                    }
                                >
                                    Next
                                </button>

                                {/* Last Button */}
                                <button
                                    type="button"
                                    className="btn btn-outline-primary"
                                    disabled={pagination.current_page===pagination.last_page}
                                    onClick={() => loadEmployees(pagination.last_page)}
                                >
                                    Last
                                </button>
                            

                            </div>
                        </div>
                    )}
                </div>

            </div>

        </div >
    );
}

export default EmployeeList;