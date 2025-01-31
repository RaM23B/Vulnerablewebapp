<div class="card p-4">
    <h3>HTTP Parameter Pollution (HPP) Demonstration</h3>
    <p>This demonstrates how multiple parameters with the same name can be handled by the server.</p>

    <form method="GET" action="" class="mb-4">
        <div class="mb-3">
            <label for="parameter" class="form-label">Enter Parameters (e.g., test=1&test=2&test=3):</label>
            <input type="text" id="parameter" name="query" value="test=1&test=2&test=3" class="form-control" placeholder="Enter parameters">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        parse_str($_GET['query'], $params); // Parse the query string

        echo "<div class='alert alert-info'>";
        echo "<b>Parameters Received:</b><br>";
        if (isset($params['test'])) {
            if (is_array($params['test'])) {
                echo "Test parameter is an array:<br>";
                foreach ($params['test'] as $key => $value) {
                    echo "test[" . $key . "] = " . $value . "<br>";
                }
            } else {
                echo "test = " . $params['test'] . "<br>";
            }
        } else {
            echo "No 'test' parameter found.<br>";
        }
        echo "<br>";
        echo "<b>All Parameters:</b><br>";
        echo "<pre>";
        print_r($params);
        echo "</pre>";

        echo "</div>";

        //Example of potential vulnerability if parameters were used in a query:
        if (isset($params["order"])) {
            $order_by = $params["order"];
            echo "<div class='alert alert-warning'><b>Potential Vulnerability:</b><br>";
            echo "SQL Query (simulated): SELECT * FROM products ORDER BY " . $order_by . "<br>";
            echo "</div>";
        }


    }
    ?>
</div>
