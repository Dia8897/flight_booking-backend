import React, { useEffect, useState } from 'react';

function Passengers() {
    const [passengers, setPassengers] = useState([]);
    const [message, setMessage] = useState('');

    useEffect(() => {
        fetch('/api/passengers')
            .then(res => res.json())
            .then(data => setPassengers(data));
    }, []);

    const softDelete = (id) => {
        if (!window.confirm('Soft delete this passenger?')) return;

        fetch(`/api/passengers/${id}/soft-delete`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() },
        })
            .then(res => {
                if (res.ok) {
                    setPassengers(passengers.filter(p => p.id !== id));
                    setMessage('Passenger soft deleted.');
                } else {
                    setMessage('Failed to delete passenger.');
                }
            });
    };

    // For Laravel CSRF token from meta tag or cookie if needed
    const getCsrfToken = () => {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        return tokenMeta ? tokenMeta.content : '';
    };

    return (
        <div>
            <h2>Passengers List</h2>
            {message && <div className="alert alert-info">{message}</div>}
            <table className="table table-striped">
                <thead>
                    <tr><th>Name</th><th>Email</th><th>DOB</th><th>Passport Expiry</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    {passengers.map(p => (
                        <tr key={p.id}>
                            <td>{p.first_name} {p.last_name}</td>
                            <td>{p.email}</td>
                            <td>{new Date(p.dob).toISOString().slice(0, 10)}</td>
                            <td>{new Date(p.passport_expiry_date).toISOString().slice(0, 10)}</td>
                            <td>
                                <button onClick={() => softDelete(p.id)} className="btn btn-sm btn-danger">Soft Delete</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Passengers;
