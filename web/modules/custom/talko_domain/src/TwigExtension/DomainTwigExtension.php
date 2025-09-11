<?php

namespace Drupal\talko_domain\TwigExtension;

use Drupal\domain\DomainNegotiatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Drupal\domain\DomainInterface;

/**
 * A custom Twig extension that provides a function to get the current domain.
 */
class DomainTwigExtension extends AbstractExtension {

  /**
   * The domain negotiator service.
   *
   * @var \Drupal\domain\DomainNegotiatorInterface
   */
  protected DomainNegotiatorInterface $domainNegotiator;

  /**
   * Constructs a new DomainTwigExtension object.
   *
   * @param \Drupal\domain\DomainNegotiatorInterface $domain_negotiator
   *   The domain negotiator service.
   */
  public function __construct(DomainNegotiatorInterface $domain_negotiator) {
    $this->domainNegotiator = $domain_negotiator;
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctions(): array {
    return [
      new TwigFunction('domain', [$this, 'getCurrentDomain']),
    ];
  }

  /**
   * Returns the current active domain object from the Domain Access module.
   *
   * @return \Drupal\domain\DomainInterface|null
   *   The active domain entity or NULL if not found.
   */
  public function getCurrentDomain(): ?DomainInterface {
    return $this->domainNegotiator->getActiveDomain();
  }

}
