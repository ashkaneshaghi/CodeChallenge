<?PHP
class VersionComparison {

    private $version_change_point = "1.0.17+60";
    
	public function compareVersion($version) {
		if (version_compare($version, $this->version_change_point) >= 0) {
			return true;
		} else {
			return false;
		}
	}
}
?>