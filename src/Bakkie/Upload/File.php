<?


namespace Bakkie\Upload;

use Upload\File as BaseFile;
use Upload\Storage\Base;

class File extends BaseFile {


    public function __construct($key, Base $storage, $options = null)
    {
        if (!isset($_FILES[$key])) {
            throw new \InvalidArgumentException("Cannot find uploaded file identified by key: $key");
        }
        $this->storage = $storage;
        $this->validations = array();
        $this->errors = array();

        if (empty($options))
        {
         
            $options['name'] = $_FILES[$key]['name'];
            $options['error'] = $_FILES[$key]['error'];
            $options['tmp_name'] = $_FILES[$key]['tmp_name'];
            
        }
        
        $this->originalName = $options['name'];
        $this->errorCode = $options['error'];
        \SplFileInfo::__construct($options['tmp_name']);

    }


}

?>