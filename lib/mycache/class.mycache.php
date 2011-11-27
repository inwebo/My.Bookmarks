<?php

class MyCache {

	var $extension;
	var $pathCache;
	var $id;

	var $birth;
	var $death;
	var $life;
	var $autostart;
	var $buffer = '' ;

	var $openTag;
	var $closeTag ;

	var $updating;

	public function __construct( $_args  ) {

		$this->args = array( 		"path"      => 'cache/',
									"id"        => NULL ,
									"autostart" => FALSE,
									"life"      => 10 );

		$this->defaultArgs = array_merge( $this->args,$_args );

		$this->openTag     = "\n" . '<!--------- ';
		$this->closeTag    = '----------->' .  "\n";
		$this->extension   = '.html';
		$this->pathCache   = $this->defaultArgs["path"];

		$this->updating = 0;
		$this->id = md5($_SERVER['REQUEST_URI'] .  $this->defaultArgs['id'] );

		// Test si le dossier cache exists
		if( !file_exists( $this->defaultArgs['path'] ) ) {
			//echo 'Dir ' . $this->defaultArgs['path'] . ' exists<br>';
			if( @mkdir($this->defaultArgs['path']) === TRUE ) {
				echo 'Make dir ' . $this->defaultArgs['path'] ."<br>";
			}
			else {
				throw new Exception('Can\'t create ' . $this->defaultArgs['path']);
			}
		}

		$this->currentFile = $this->currentFile();
		$this->buildComments();

	}

	public function start( ) {
		// File exists ?
		if( file_exists($this->currentFile) ) {
			// Is writeble ?
			if( is_writable($this->currentFile)  ) {
				// Writable
				$this->birth = (integer)filemtime( $this->currentFile );
				$this->life = $this->defaultArgs['life'];
				$this->death = $this->birth + $this->life ;

				// Cache is uptodate ?
				if(  $this->isValidCache() ) {
					// Yes it's
					readfile($this->currentFile);;
					ob_start();
				}
				else {
					// Nope it's not, generate new cache file
					$this->updating = 1;
					ob_start();
				}
			}
			else {
				throw new Exception($this->currentFile . ' is unwritable<br>');
			}
		}
		else {
			// Create new file
			$this->save();
			ob_start();
			$this->updating = 1;
			return @readfile( $this->currentFile );
		}

	}

	public function save() {

		if( $this->updating === 1 ) {
			$content = fopen( $this->currentFile, 'w+' );
			if( $content === false ) {
				throw new Exception('Can\'t create file cache.');
			}
			else {
				fputs( $content, $this->getBuffer() );
				fclose( $content );
				ob_get_clean();
			}
			return readfile($this->currentFile);
		}
		else {
			ob_get_clean();
		}

	}

	private function isValidCache() {

		if( $this->death < (integer)time()  ) {
			return false;
		}
		else {
			return true;
		}
	}

	 function currentFile() {
		return $this->pathCache . $this->id . $this->extension;
	}

	function buildComments() {
		$this->header      = $this->openTag . $this->id . $this->extension  . ' ' . $this->closeTag /*.'<span style="color:red">'*/;
		/*if($this->defaultArgs['life'] == 20 ) {
			$this->header .= '<div style="color:green">';
		}*/

		$this->footer      = /*'</span>'.*/$this->openTag . 'Generated @ : ' . strftime('%c')  . $this->closeTag ;
		/*if($this->defaultArgs['life'] == 20 ) {
			$this->footer .= '</div>';
		}*/
	}

	public function getBuffer( $htmlComments = TRUE ) {
		if( $htmlComments === TRUE ) {
			$this->buffer = $this->header;
			$this->buffer .= ob_get_contents();
			$this->buffer .= $this->footer;
		}
		else {
			$this->buffer = ob_get_contents();
		}
		return $this->buffer;
	}

}
