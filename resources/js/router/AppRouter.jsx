import React, { useState, useEffect } from 'react';
import axios from 'axios';

function AppRouter() {
    const [activeTab, setActiveTab] = useState('login');
    const [loginEmail, setLoginEmail] = useState('');
    const [loginPassword, setLoginPassword] = useState('');
    const [registerName, setRegisterName] = useState('');
    const [registerEmail, setRegisterEmail] = useState('');
    const [registerPassword, setRegisterPassword] = useState('');
    const [token, setToken] = useState(localStorage.getItem('token') || null);
    const [user, setUser] = useState(null);
    const [error, setError] = useState('');

    // Set Axios default headers
    useEffect(() => {
        axios.defaults.headers.common['Content-Type'] = 'application/json';
        axios.defaults.headers.common['Accept'] = 'application/json';
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        } else {
            delete axios.defaults.headers.common['Authorization'];
        }
    }, [token]);

    const handleLogin = async () => {
        try {
            const response = await axios.post('http://localhost/api/auth/login', {
                email: loginEmail,
                password: loginPassword,
            });
            const accessToken = response.data.access_token;
            setToken(accessToken);
            localStorage.setItem('token', accessToken);
            setError('');
            // alert('Login successful');
        } catch (err) {
            setError('Login failed: ' + (err.response?.data?.error || err.message));
        }
    };

    const handleRegister = async () => {
        try {
            const response = await axios.post('http://localhost/api/auth/register', {
                name: registerName,
                email: registerEmail,
                password: registerPassword,
            });
            const accessToken = response.data.access_token;
            setToken(accessToken);
            localStorage.setItem('token', accessToken);
            setError('');
            // alert('Registration successful');
        } catch (err) {
            const errors = err.response?.data?.errors || {};
            const errorMessages = Object.keys(errors)
                .map((key) => `${key.charAt(0).toUpperCase() + key.slice(1)}: ${errors[key].join(', ')}`)
                .join(' | ');
            setError(`Registration failed: ${errorMessages}`);
        }
    };

    const fetchUser = async () => {
        try {
            const response = await axios.post('http://localhost/api/auth/user');
            setUser(response.data);
            setError('');
        } catch (err) {
            setError('Fetch user failed: ' + (err.response?.data?.message || err.message));
        }
    };

    const handleLogout = async () => {
        try {
            await axios.post('http://localhost/api/auth/logout');
        } catch (err) {
            console.log('Logout request failed:', err.response?.data?.message || err.message);
        }
        setToken(null);
        setUser(null);
        localStorage.removeItem('token');
        setError('');
        // alert('Logged out');
    };

    useEffect(() => {
        if (!token) {
            setUser(null);
        }
    }, [token]);

    return (
        <div className="App">
            <h1>Authentication App</h1>

            {!token ? (
                <div>
                    <div>
                        <button
                            onClick={() => setActiveTab('login')}
                            style={{ marginRight: '10px', fontWeight: activeTab === 'login' ? 'bold' : 'normal' }}
                        >
                            Login
                        </button>
                        <button
                            onClick={() => setActiveTab('register')}
                            style={{ fontWeight: activeTab === 'register' ? 'bold' : 'normal' }}
                        >
                            Register
                        </button>
                    </div>

                    {activeTab === 'login' && (
                        <div>
                            <h2>Login</h2>
                            <input
                                type="email"
                                placeholder="Email"
                                value={loginEmail}
                                onChange={(e) => setLoginEmail(e.target.value)}
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                value={loginPassword}
                                onChange={(e) => setLoginPassword(e.target.value)}
                            />
                            <button onClick={handleLogin}>Login</button>
                        </div>
                    )}

                    {activeTab === 'register' && (
                        <div>
                            <h2>Register</h2>
                            <input
                                type="text"
                                placeholder="Name"
                                value={registerName}
                                onChange={(e) => setRegisterName(e.target.value)}
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                value={registerEmail}
                                onChange={(e) => setRegisterEmail(e.target.value)}
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                value={registerPassword}
                                onChange={(e) => setRegisterPassword(e.target.value)}
                            />
                            <button onClick={handleRegister}>Register</button>
                        </div>
                    )}
                </div>
            ) : (
                <div>
                    <h2>User Actions</h2>
                    <button onClick={fetchUser}>Get User Info</button>
                    <button onClick={handleLogout}>Logout</button>
                </div>
            )}

            {user && (
                <div>
                    <h3>User Info</h3>
                    <p>ID: {user.id}</p>
                    <p>Name: {user.name}</p>
                    <p>Email: {user.email}</p>
                </div>
            )}

            {error && <p style={{ color: 'red' }}>{error}</p>}
        </div>
    );
}
export default AppRouter;
