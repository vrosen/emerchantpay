import React, {useState, useEffect, useContext} from "react";
import {AuthContext} from "../context/AuthProvider";
import {Button, Card, Col, Container, FloatingLabel, Form, Row} from "react-bootstrap";

const Login = () => {

    const {loggedIn, signIn} = useContext(AuthContext);

    const [data, setData] = useState({
        email: "",
        password: ""
    });

    const handleChange = (e) => {
        setData({...data, [e.target.name]: e.target.value});
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        const postData = {
            email: data.email,
            password: data.password
        }

        signIn(postData);
    }

    return (
        <Container fluid className="mb-5">
            <Row>
                <Col xs={12} md={4}></Col>
                <Col xs={12} md={4}>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group className="mb-3" controlId="Title">
                            <Form.Label>Title</Form.Label>
                            <Form.Control type="email" name="email" required={true} placeholder="Title..."
                                          onChange={handleChange} value={data.email}/>
                        </Form.Group>
                        <Form.Group className="mb-3" controlId="Title">
                            <Form.Label>Title</Form.Label>
                            <Form.Control type="password" name="password" required={true} placeholder="Title..."
                                          onChange={handleChange} value={data.password}/>
                        </Form.Group>
                        <Button type="submit" className="btn btn-primary">Submit</Button>
                    </Form>
                </Col>
                <Col xs={12} md={4}></Col>
            </Row>
        </Container>
    );
}

export default Login;
