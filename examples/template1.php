<p>
    I am the template file. wuddup???
</p>

<?php foreach($cars as $car) : ?>
    <p> 
        make: <?php echo $car['make']; ?> <br />
        model: <?php echo $car['model']; ?> <br />
        year: <?php echo $car['year']; ?>
    </p>
<?php endforeach; ?>