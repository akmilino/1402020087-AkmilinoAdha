<?php
class Post
{
  // DB stuff
  private $conn;
  private $table = 'aksesoris';

  // Post Properties
  public $id;
  public $nama_barang;
  public $jumlah;
  public $harga;


  // Constructor with DB
  function __construct($db)
  {
    $this->conn = $db;
  }

  // Get Posts
  public function read()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Post
  public function read_single()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->id = $row['id'];
    $this->nama_barang = $row['nama_barang'];
    $this->jumlah = $row['jumlah'];
    $this->harga = $row['harga'];
  }

  public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' 
            SET 
              id = :id,
              nama_barang = :nama_barang, 
              jumlah = :jumlah, 
              harga = :harga';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->nama_barang = htmlspecialchars(strip_tags($this->nama_barang));
          $this->jumlah = htmlspecialchars(strip_tags($this->jumlah));
          $this->harga = htmlspecialchars(strip_tags($this->harga));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':nama_barang', $this->nama_barang);
          $stmt->bindParam(':jumlah', $this->jumlah);
          $stmt->bindParam(':harga', $this->harga);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . ' 
        SET 
          jumlah = :jumlah
        WHERE
        id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->jumlah = htmlspecialchars(strip_tags($this->jumlah));

      // Bind data
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':jumlah', $this->jumlah);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

     public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

}
