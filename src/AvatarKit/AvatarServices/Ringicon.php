<?php

declare(strict_types = 1);

namespace dpi\ak_ringicon\AvatarKit\AvatarServices;

use dpi\ak\AvatarIdentifierInterface;
use splitbrain\RingIcon\RingIcon as RingiconLib;

/**
 * Ringicon.
 *
 * @AvatarService(
 *   id = "ringicon",
 *   name = "Ringicon",
 *   description = "Rings as provided by Ringicon.",
 *   protocols = {
 *     "file"
 *   },
 *   mime = {
 *     "image/png"
 *   },
 *   dimensions = "1x1-1024x1024",
 *   is_dynamic = FALSE,
 *   is_fallback = TRUE,
 *   is_remote = FALSE
 * )
 */
class Ringicon extends RingiconBase {

  /**
   * {@inheritdoc}
   */
  public function getAvatar(AvatarIdentifierInterface $identifier): ?string {
    $width = $this->getConfiguration()->getWidth();

    $ringicon = new RingiconLib($width, 3);

    $identifier = $identifier->getHashed();
    $file_path = tmpfile();
    $ringicon->createImage($identifier, $file_path);

    $metadata = stream_get_meta_data($file_path);
    return $metadata['uri'] ?? NULL;
  }

}
