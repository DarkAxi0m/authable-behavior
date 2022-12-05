/**
 * Sets the hashed password
 *
 * @param string
 * @return $this
 */
public function setPassword($v)
{
    $v = password_hash($v, <?php echo $algo; ?>);
    return $this-><?php echo $setcolumn; ?>($v);
}

/**algo
 * Checks the password against the hash
 *
 * @param string
 * @return $this
 */
public function passwordVerify($v)
{
    return password_verify($v, $this-><?php echo $column; ?>);
}