<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Management</title>
    <link rel="stylesheet" href="./css/style2.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="user-info">
                <img src="user-icon.png" alt="User Icon">
                <span>Sarah</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Quick Search">
            </div>
            <div class="sos-icon">
                <span>SOS</span>
            </div>
        </header>
        <nav>
            <ul>
            <li ><a href="../index.php" style="color: black">Dashboard</a></li>
            <li ><a href="serviceprovider.php" style="color: black">Services Provider</a></li>
                <li>View Customer Records</li>
                <li class="active "><a href="service.php" style="color: black">Manage Services</a></li>

            </ul>
        </nav>
        <main>
            <div class="add-service-form">
                <h2>Add Service</h2>
                <form>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="">Select Category</option>
                            <!-- Add categories here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service-code">Service Code</label>
                        <input type="text" id="service-code" name="service-code" placeholder="Code">
                    </div>
                    <div class="form-group">
                        <label for="service-name">Name</label>
                        <input type="text" id="service-name" name="service-name" placeholder="Service Name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <select id="quantity" name="quantity">
                            <option value="">Select Unit</option>
                            <!-- Add units here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (Per Quantity)</label>
                        <input type="number" id="price" name="price" value="0">
                    </div>
                    <div class="form-buttons">
                        <button type="button" class="delete-button">Delete</button>
                        <button type="button" class="close-button">Close</button>
                        <button type="submit" class="add-service-button">Add Service</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="./js/script2.js"></script>
</body>
</html>
