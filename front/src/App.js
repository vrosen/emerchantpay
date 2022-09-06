import {useContext} from "react";
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Home from "./pages/Home";
import CreatePost from "./pages/CreatePost";
import Login from "./pages/Login";
import Admin from "./pages/Admin";
import {AuthContext} from "./context/AuthProvider";
import EditPost from "./pages/EditPost";
import Nav from 'react-bootstrap/Nav';

const App = () => {

    const {loggedIn, admin} = useContext(AuthContext);

    const signUserOut = () => {
        localStorage.clear();
        window.location.pathname = "/login";
    };

    return (
        <Router>
            <Nav activeKey="/" className="justify-content-center mb-5 mt-2" >
                <Nav.Item>
                    <Nav.Link href="/">Home</Nav.Link>
                </Nav.Item>
                {!loggedIn ? (
                    <Nav.Item>
                        <Nav.Link href="/login">Login</Nav.Link>
                    </Nav.Item>
                ) : (
                    <>
                        { admin ? <Nav.Item>
                            <Nav.Link href="/admin">Admin</Nav.Link>
                        </Nav.Item> : '' }
                        { admin ? <Nav.Item>
                            <Nav.Link href="/createpost">New post</Nav.Link>
                        </Nav.Item> : '' }
                        <Nav.Item>
                            <Nav.Link onClick={signUserOut}>Log Out</Nav.Link>
                        </Nav.Item>
                    </>
                )}
            </Nav>
            <Routes>
                <Route path="/" element={<Home loggedIn={loggedIn}/>}/>
                <Route path="/createpost" element={<CreatePost loggedIn={loggedIn}/>}/>
                <Route path="/editpost/:id" element={<EditPost loggedIn={loggedIn}/>}/>
                <Route path="/admin" element={<Admin loggedIn={loggedIn}/>}/>
                <Route path="/login" element={<Login loggedIn={loggedIn}/>}/>
            </Routes>
        </Router>
    );
}

export default App;
