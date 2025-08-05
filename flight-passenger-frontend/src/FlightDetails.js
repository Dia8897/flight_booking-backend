import React, { useEffect, useState } from 'react';
import { useParams, Link } from 'react-router-dom';

function FlightDetails() {
    const { id } = useParams();
    const [flight, setFlight] = useState(null);

    useEffect(() => {
        fetch(`/api/flights/${id}`)
            .then(res => res.json())
            .then(data => setFlight(data));
    }, [id]);

    if (!flight) return <div>Loading...</div>;

    return (
        <div>
            <h2>Flight {flight.number} Passengers</h2>
            <Link to="/flights" className="btn btn-secondary mb-3">Back to Flights</Link>
            {flight.passengers.length === 0 ? (
                <p>No passengers on this flight.</p>
            ) : (
                <table className="table table-hover">
                    <thead><tr><th>Name</th><th>Email</th></tr></thead>
                    <tbody>
                        {flight.passengers.map(p => (
                            <tr key={p.id}>
                                <td>{p.first_name} {p.last_name}</td>
                                <td>{p.email}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}

export default FlightDetails;
