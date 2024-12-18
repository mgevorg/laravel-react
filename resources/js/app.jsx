import './bootstrap';
import React from "react";
import ReactDOM from 'react-dom/client';
import "./axios";
import './components/app.css';

import AppRouter from './router/AppRouter.jsx'

function App() {
    return <AppRouter />;
}

ReactDOM.createRoot(document.getElementById('app')).render(
    <AppRouter/>
)
