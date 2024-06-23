<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="profile">
                <div class="profile-icon">😊</div>
                <p>Sarah</p>
            </div>
            <ul class="menu">
            <li ><a href="../index.php" style="color: black">Dashboard</a></li>
                <li class="active" ><a href="serviceprovider.php" style="color: white">Services Provider</a></li>
                <li>View Customer Records</li>
                <li><a href="service.php" style="color: white">Manage Services</a></li>
                
            </ul>
        </aside>
        <main class="main-content">
            <header class="header">
                <input type="text" placeholder="Quick Search" class="search-bar">
            </header>
            <section class="services-provider">
                <div class="card">
                    <div class="card-icon">👷</div>
                    <h3>Walid Ahmed</h3>
                    <p>Plumber</p>
                    <p>More than just pipes and wrenches, they bring the comfort of gurgling faucets and steamy showers, one satisfied customer at a time.</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <button class="btn">Remove</button>
                    <button class="btn">Add service</button>
                </div>
                <div class="card">
                    <div class="card-icon">👷</div>
                    <h3>Adel Eiz</h3>
                    <p>Electrical</p>
                    <p>With calloused hands and a keen eye, they navigate the invisible currents, bringing power and light to everyday life.</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <button class="btn">Remove</button>
                    <button class="btn">Add service</button>
                </div>
                <div class="card">
                    <div class="card-icon">👷</div>
                    <h3>Nadia Masoad</h3>
                    <p>Cleaner</p>
                    <p>Transform chaos into calm, dust bunnies into sparkling surfaces, and cluttered corners into havens of order. More than just cleaners, they are the unseen guardians of comfort, ensuring a space reflects peace and purpose.</p>
                    <div class="rating">⭐⭐⭐⭐⭐</div>
                    <button class="btn">Remove</button>
                    <button class="btn">Add service</button>
                </div>
            </section>
            <section class="service-details">
                <table>
                    <thead>
                        <tr>
                            <th>SP Name</th>
                            <th>Number</th>
                            <th>Service Code</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td contenteditable="false">Walid Ahmed</td>
                            <td contenteditable="false">001</td>
                            <td contenteditable="false">#G001</td>
                            <td contenteditable="false">Cleaning</td>
                            <td contenteditable="false">$50</td>
                            <td contenteditable="false"><input type="number" value="1" disabled></td>
                            <td>$50</td>
                            <td>
                                <button class="btn edit">Edit</button>
                                <button class="btn remove">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td contenteditable="false">Adel Eiz</td>
                            <td contenteditable="false">002</td>
                            <td contenteditable="false">#A001</td>
                            <td contenteditable="false">Plumbing</td>
                            <td contenteditable="false">$75</td>
                            <td contenteditable="false"><input type="number" value="1" disabled></td>
                            <td>$75</td>
                            <td>
                                <button class="btn edit">Edit</button>
                                <button class="btn remove">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn add">Add</button>
            </section>
        </main>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>
