<?= $this->fetch('header.php') ?>
<main id="main">
    <section id="featured-services" class="featured-services">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-3 col-md-6 d-flex">
                    <h2>API routes description</h2>
                </div>
            </div>
            <div class="row gy-4">
                <div class="row gy-4">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h5>Retrieve all posts</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Request</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>
                            <span style="font-weight: bold;color: #0dcaf0">GET</span>
                            &nbsp;&nbsp;<span>/api/v1/posts</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Response</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <span>
                            <pre class="prettyprint" style="padding: 0;border: unset;margin-left: 0;margin-bottom: 0;overflow: unset">
{
"data":
    [
        {
            "id":"2",
            "title":"New title",
            "content":"cdscdscdsc"
        },
        {
            "id":"1",
            "title":"Test",
            "content":"dcdcdcdc"
        }
    ]
}
                            </pre>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                <div class="row gy-4">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h5>Retrieve one post</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Request</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>
                            <span style="font-weight: bold;color: #0dcaf0">GET</span>
                            &nbsp;&nbsp;<span>/api/v1/posts/: id</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <table>
                            <tr>
                                <td>id</td>
                                <td>:</td>
                                <td>integer</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Response</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <span>
                            <pre class="prettyprint" style="padding: 0;border: unset;margin-left: 0;margin-bottom: 0;overflow: unset">
{
"data":
    {
        "id":"2",
        "title":"New title",
        "content":"cdscdscdsc"
    }
}
                            </pre>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                <div class="row gy-4">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h5>Create new post</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Request</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>
                            <span style="font-weight: bold;color: #0dcaf0">POST</span>
                            &nbsp;&nbsp;<span>/api/v1/posts</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <span>
                            <pre class="prettyprint" style="padding: 0;border: unset;margin-left: 0;margin-bottom: 0;overflow: unset">
{
    "title":"New title",
    "content":"cdscdscdsc"
}
                            </pre>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <table>
                            <tr>
                                <td>title</td>
                                <td>:</td>
                                <td>string</td>
                                <td></td>
                                <td>max char : 50</td>
                            </tr>
                            <tr>
                                <td>content</td>
                                <td>:</td>
                                <td>text</td>
                                <td></td>
                                <td>max char : 200</td>
                            </tr>
                            <tr>
                                <td>image</td>
                                <td>:</td>
                                <td>blob</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                <div class="row gy-4">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h5>Update post</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Request</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>
                            <span style="font-weight: bold;color: #0dcaf0">POST</span>
                            &nbsp;&nbsp;<span>/api/v1/posts/: id</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <table>
                            <tr>
                                <td>id</td>
                                <td>:</td>
                                <td>integer</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row gy-4">
                <div class="row gy-4">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h5>Login</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>Request</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <h6>
                            <span style="font-weight: bold;color: #0dcaf0">POST</span>
                            &nbsp;&nbsp;<span>/api/v1/login</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex">
                        <span>
                            <pre class="prettyprint" style="padding: 0;border: unset;margin-left: 0;margin-bottom: 0;overflow: unset">
{
    "email":"some@email.com",
    "password":"qwerty"
}
                            </pre>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->fetch('footer.php') ?>
