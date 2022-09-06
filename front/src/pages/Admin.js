import React, {useEffect, useState} from "react";
import axios from "axios"
import {loadState} from "../library/localStorage";
import {Button, Card, Container, Row, Col} from 'react-bootstrap';

function Admin() {
    const [postLists, setPostList] = useState([]);
    const [admin, setAdmin] = useState(false);

    useEffect(() => {
        const getPosts = async () => {
            const data = await axios.get('http://localhost:8000/api/v1/posts');
            if (data.data){
                setPostList(data.data);
            }
        };
        getPosts();

        let check = loadState('admin');
        if (check) {
            setAdmin(true);
        }else{
            window.location.pathname = "/";
        }

    }, []);

    return (
        <Container fluid>

            {postLists.map((post) => {
                return (
                    <Row key={post.id}>
                        <Col xs={12} md={2}></Col>
                        <Col xs={12} md={8} key={post.id}>
                            <Card className="mb-3" key={post.id} >
                                {post.url ? <Card.Img variant="top" src={post.url} height="350" /> : ''}
                                <Card.Body>
                                    <Card.Title>{post.title}</Card.Title>
                                    <Card.Text>
                                        {post.content}
                                    </Card.Text>
                                    { admin ? <Button href={'/editpost/'+post.id} variant="primary">Edit</Button> : ''}
                                </Card.Body>
                            </Card>
                        </Col>
                        <Col xs={12} md={2}></Col>
                    </Row>
                );
            })}

        </Container>
    );
}

export default Admin;
