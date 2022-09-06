import React, {useState, useEffect} from "react";
import {useNavigate, useParams} from "react-router-dom";
import axios from "axios";
import {loadState} from "../library/localStorage";
import {Button, Card, Col, Container, FloatingLabel, Form, Row} from "react-bootstrap";

const EditPost = () => {

    const [token, setToken] = useState('');
    const [user, setUser] = useState([]);
    const [post, setPost] = useState([]);
    const [selectedImage, setSelectedImage] = useState(null);
    const { id } = useParams();

    let navigate = useNavigate();

    const [data, setData] = useState({
        title: post.title,
        content: post.content
    });

    const handleChange = (e) => {
        setData({...data, [e.target.name]: e.target.value});
    }

    const handleImage = (e) => {
        let image = e.target.files[0];

        // if (image.type !== "image/jpeg") {
        //     alert("Allowed file types are jpeg and png!")
        //     return;
        // }

        setSelectedImage(image);
    }

    useEffect(() => {

        let storedUser = loadState('user');

        if (storedUser.jwt_token){
            setToken(storedUser.jwt_token)
            setUser(storedUser)
        }

        if (!user){
            navigate('/');
        }

        const getPost = async () => {
            const data = await axios.get('http://localhost:8000/api/v1/posts/'+id).then(response => {
                setPost(response.data);
            })
        };

        getPost();

    }, []);

    const config = {
        headers: { Authorization: `Bearer ${token}` }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();

        formData.append('user_id', user.id);
        formData.append('title', data.title ?? post.title);
        formData.append('content', data.content ?? post.content);
        formData.append('image', selectedImage);

        axios.post('http://localhost:8000/api/v1/posts/' + id, formData, config)
            .then((response) => {
                navigate('/');
        })
    }

    return (
        <Container fluid className="mb-5">
            <Row>

                <Col xs={12} md={4}></Col>
                <Col xs={12} md={4}>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group className="mb-3" controlId="Title">
                            <Form.Label>Title</Form.Label>
                            <Form.Control type="text" name="title" required={true} placeholder="Title..."
                                          onChange={handleChange} defaultValue={post.title}/>
                        </Form.Group>
                        <FloatingLabel controlId="Content" label="Content">
                            <Form.Control
                                name="content"
                                onChange={handleChange} defaultValue={post.content}
                                as="textarea"
                                placeholder="Content here"
                                style={{ height: '100px' }}
                            />
                        </FloatingLabel>
                        <Form.Group controlId="formFile" className="mb-3">
                            { !selectedImage ? <Card className="mt-3">
                                <Card.Img variant="top" src={post.url} />
                            </Card> : '' }
                            <Form.Label></Form.Label>
                            <Form.Control type="file" name="myImage" onChange={handleImage}/>
                            <div>
                                {selectedImage && (
                                    <Card className="mt-3">
                                        <Card.Img variant="top" src={URL.createObjectURL(selectedImage)} />
                                        <Card.Body>
                                            <Button onClick={()=>setSelectedImage(null)}>Remove</Button>
                                        </Card.Body>
                                    </Card>
                                )}
                            </div>
                        </Form.Group>
                        <Button variant="primary" type="submit">
                            Save
                        </Button>
                    </Form>
                </Col>
                <Col xs={12} md={4}></Col>
            </Row>
        </Container>

    );
}

export default EditPost;
