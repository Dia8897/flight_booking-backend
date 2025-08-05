import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

function Flights() {
    const [flights, setFlights] = useState([]);

    useEffect(() => {
        fetch('/api/flights')
            .then(res => res.json())
            .then(data => setFlights(data));
    }, []);

    return (
        <div>
            <h2>Flights List</h2>
            <table className="table table-bordered">
                <thead>
                    <tr>
                        <th>Flight Number</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Times</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    {flights.map(f => (
                        <tr key={f.id}>
                            <td>{f.number}</td>
                            <td>{f.departure_city}</td>
                            <td>{f.arrival_city}</td>
                            <td>{new Date(f.departure_time).toLocaleString()} - {new Date(f.arrival_time).toLocaleString()}</td>
                            <td><Link to={`/flights/${f.id}`} className="btn btn-primary btn-sm">View Passengers</Link></td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Flights;
