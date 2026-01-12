<?php
session_start();
require("./header.php");
?>
<style>
    @media (max-width: 768px) {
        .center,
        .center-text,
        .center-form {
            margin: auto;
            padding: 15px;
        }

        .anket-button {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>

<div class="col container">
    <div class="center">
        <a href="/processing/processingTest.php" class="d-block mb-3 link-primary text-decoration-none">
            <button class="btn btn-outline-secondary anket-button" type="button">Пройти анкету</button>
        </a>
        <a href="/processing/processingForm.php" class="d-block mb-3 link-primary text-decoration-none">
            <button class="btn btn-primary anket-button" type="button">Вызвать специалиста</button>
        </a>
    </div>
</div>

<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="col center-text">
    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-body">
            <h1 class="card-title pricing-card-title text-center">
                <?php
                if (isset($_SESSION['message']) && $_SESSION['message'] != 0) {
                    echo '<p id="err">' . $_SESSION['message'] . '</p>';
                }
//                unset($_SESSION['message']);
                ?>
                <small class="text-body-secondary fw-light"></small>
            </h1>
        </div>
    </div>
</div>

</main>
</body>
</html>

