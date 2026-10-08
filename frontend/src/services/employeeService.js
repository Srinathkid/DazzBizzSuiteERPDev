import api from './api';

const employeeService = {

    getAll: async (params = {}) => {
        const response = await api.get('/api/v1/employees', {
            params,
        });

        return response.data;
    },

    getById: async (id) => {
        const response = await api.get(`/api/v1/employees/${id}`);

        return response.data;
    },

    create: async (employeeData) => {
        const response = await api.post(
            '/api/v1/employees',
            employeeData
        );

        return response.data;
    },

    update: async (id, employeeData) => {
        const response = await api.put(
            `/api/v1/employees/${id}`,
            employeeData
        );

        return response.data;
    },

    delete: async (id) => {
        const response = await api.delete(
            `/api/v1/employees/${id}`
        );

        return response.data;
    },
};

export default employeeService;