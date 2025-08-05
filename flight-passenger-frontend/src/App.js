import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import Passengers from './Passengers';
import Flights from './Flights';
import FlightDetails from './FlightDetails';

function App() {
  return (
    <Router>
      <nav className="navbar navbar-expand navbar-dark bg-primary">
        <div className="container">
          <Link className="navbar-brand" to="/">Flight-Passenger</Link>
          <div className="navbar-nav">
            <Link className="nav-link" to="/passengers">Passengers</Link>
            <Link className="nav-link" to="/flights">Flights</Link>
          </div>
        </div>
      </nav>
      <div className="container mt-4">
        <Routes>
          <Route path="/passengers" element={<Passengers />} />
          <Route path="/flights" element={<Flights />} />
          <Route path="/flights/:id" element={<FlightDetails />} />
          <Route path="/" element={<h2>Welcome to Flight-Passenger App</h2>} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
