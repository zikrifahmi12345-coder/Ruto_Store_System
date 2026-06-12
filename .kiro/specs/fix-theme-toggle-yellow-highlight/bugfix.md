# Bugfix Requirements Document

## Introduction

This bugfix addresses an overly bright yellow highlight that appears when the dark/light mode toggle button is pressed on the user page. The current implementation uses the primary brand color (`#ffbe33`) for the hover state, but lacks proper `:active` and `:focus` states to provide a softer, more subtle visual feedback when the button is pressed or focused. This creates a jarring visual experience that doesn't align with the overall design aesthetic of softer, warm tones throughout the interface.

## Bug Analysis

### Current Behavior (Defect)

1.1 WHEN the theme toggle button (`.rc-hero-theme`) is pressed (`:active` state) THEN the system displays the bright yellow brand color (`#ffbe33`) without any visual softening

1.2 WHEN the theme toggle button receives keyboard focus (`:focus` state) THEN the system does not provide any distinct visual feedback for accessibility

1.3 WHEN the theme toggle button is pressed THEN the system may show browser default focus rings or hover states that conflict with the design system

### Expected Behavior (Correct)

2.1 WHEN the theme toggle button is pressed (`:active` state) THEN the system SHALL display a softer, darker shade of the brand color (e.g., `#e69c00` or similar) with reduced opacity to create a subtle pressed effect

2.2 WHEN the theme toggle button receives keyboard focus (`:focus` state) THEN the system SHALL display a subtle focus ring or outline that provides clear visual feedback for keyboard navigation without overwhelming the design

2.3 WHEN the theme toggle button is pressed THEN the system SHALL apply a smooth transition and slightly reduced scale to enhance the tactile feedback

### Unchanged Behavior (Regression Prevention)

3.1 WHEN the theme toggle button is in its default (non-interactive) state THEN the system SHALL CONTINUE TO display the background color defined by `var(--rc-border-subtle)` and border as currently implemented

3.2 WHEN the theme toggle button is hovered (`:hover` state) THEN the system SHALL CONTINUE TO display the brand color (`var(--ruto-brand)`) background with white text as currently implemented

3.3 WHEN the theme toggle button is clicked THEN the system SHALL CONTINUE TO toggle between dark and light themes as currently implemented

3.4 WHEN the theme toggle button scales on scroll (sticky header) THEN the system SHALL CONTINUE TO apply the `transform: scale(0.85)` animation as currently implemented
