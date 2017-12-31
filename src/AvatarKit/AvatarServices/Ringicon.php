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
    $ringicon = new RingiconLib($width, 3);

    $identifier = $identifier->getHashed();
    $file_path = tempnam(sys_get_temp_dir(), 'ringicon');
    $ringicon->createImage($identifier, $file_path);

    return $file_path;
  }

}
