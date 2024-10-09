const oracledb = require('oracledb');

async function connectToOracle() {
  let connection;

  try {
    connection = await oracledb.getConnection({
      user: "sys",
      password: "123",
      connectString: "1522"  // Modify as per your DB service name
    });

    console.log("Connected to Oracle 12c");

    // Execute a query
    const result = await connection.execute(`SELECT * FROM Users`);
    console.log(result.rows);

  } catch (err) {
    console.error(err);
  } finally {
    if (connection) {
      try {
        await connection.close();
      } catch (err) {
        console.error(err);
      }
    }
  }
}

connectToOracle();
