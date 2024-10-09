<?php
// Connect to Oracle 12c database
$conn = oci_connect('QLDonHang', '123', 'localhost'); // XE for Express Edition, change to your service name

if (!$conn) {
    $e = oci_error();
    echo "Connection failed: " . $e['message'];
    exit;
}

// Example query to get users
$query = "SELECT * FROM NguoiDung";
$stid = oci_parse($conn, $query);
oci_execute($stid);

// Fetch data
echo "<table border='1'><tr><th>User ID</th><th>Username</th><th>Email</th></tr>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>";
    foreach ($row as $item) {
        echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Close the connection
oci_free_statement($stid);
oci_close($conn);
?>
