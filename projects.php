<?php
include('includes/db.php');

$query = "SELECT * FROM projects WHERE status = 'validated'";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " AND title LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
?>

<form method="get" action="">
    <input type="text" name="search" placeholder="Rechercher un projet">
    <button type="submit">Rechercher</button>
</form>

<?php while ($project = mysqli_fetch_assoc($result)) { ?>
    <div>
        <h3><?php echo $project['title']; ?></h3>
        <p><?php echo $project['description']; ?></p>
    </div>
<?php } ?>
