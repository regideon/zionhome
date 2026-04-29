# ZionHome Concerns & Feedback Module

ZionHome includes a module called **Concerns & Feedback**.

This module is not only for complaints. It must support both negative and positive homeowner submissions.

## Purpose

Homeowners can submit:

- concerns
- complaints
- suggestions
- appreciation
- maintenance requests
- security concerns
- billing concerns
- inquiries

The module should feel like a transparent community support system.

---

## Core Tables

Use:

- feedbacks
- feedback_types
- feedback_statuses
- feedback_priorities
- feedback_categories
- feedback_comments
- feedback_attachments
- feedback_ai_logs

---

## Feedback Types

Default types:

- Concern
- Complaint
- Suggestion
- Appreciation
- Maintenance Request
- Security Concern
- Billing Concern
- Inquiry
- Other

---

## Feedback Statuses

Default statuses:

- Submitted
- Under Review
- Assigned
- In Progress
- Resolved
- Closed
- Cancelled

---

## Feedback Priorities

Default priorities:

- Emergency
- High
- Medium
- Low

---

## Feedback Categories

Default categories:

- Security
- Maintenance
- Billing
- Amenities
- Sanitation
- Water Supply
- Electrical
- Noise Complaint
- Parking
- Community Suggestion
- Positive Feedback
- Other

---

## World-Class Workflow

When a homeowner submits feedback:

1. Create feedback record
2. Attach photos/videos if provided
3. Run AI triage
4. AI detects:
    - category
    - sentiment
    - risk level
    - priority
    - suggested action
5. If emergency/high risk:
    - mark as emergency
    - notify admin/security
    - prioritize in dashboard
6. Route to correct department/team
7. Admin can comment internally
8. Homeowner sees status tracking:
    - Submitted
    - Under Review
    - Assigned
    - In Progress
    - Resolved
    - Closed

---

## Important Business Rules

Do not call this module only "Concerns".

Always use:

**Concerns & Feedback**

because the system supports both complaints and positive community feedback.

Positive feedback should be preserved and visible to admin.

Examples:

- Thank you to guard Ramon
- Maintenance team responded quickly
- Community event was well organized

---

## AI Logic

AI logs must be saved in:

feedback_ai_logs

Store:

- detected_category
- detected_sentiment
- detected_priority
- is_high_risk
- summary
- suggested_action
- raw_response

---

## Community Heat Map

Admin dashboard should eventually use feedback data to show:

- issue hotspots by phase/street/block
- recurring problems
- emergency clusters
- positive feedback clusters
- AI-generated insights

Examples:

- Security reports are increasing near Gate 1
- Water issues are recurring in Phase 2
- Positive feedback increased for guard assistance

---

## Filament PHP 5 Rule

When creating Filament resources, always use the Filament 5 structure:

Feedbacks/
├── FeedbackResource.php
├── Pages/
├── Schemas/
│ └── FeedbackForm.php
└── Tables/
└── FeedbacksTable.php

Do not use old Filament v3/v4 resource structure.
