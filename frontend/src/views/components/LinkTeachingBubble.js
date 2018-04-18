import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { Link, TeachingBubble } from 'office-ui-fabric-react'

class LinkTeachingBubble extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isVisible: false
    }

    this.toggleHelpBubble = this.toggleHelpBubble.bind(this)
  }

  toggleHelpBubble () {
    this.setState(prevState => ({ isVisible: !prevState.isVisible }))
  }

  render () {
    const { isVisible } = this.state
    const {
      linkName,
      title,
      description,
      primaryButton,
      secondaryButton
    } = this.props

    const defaultSecondaryButtonProps = {
      children: 'Agora, não',
      onClick: this.toggleHelpBubble
    }

    return <div>
      <span ref={lk => { this.linkRef = lk }}>
        <Link onClick={this.toggleHelpBubble}>{ linkName }</Link>
      </span>
      {isVisible && <TeachingBubble
        targetElement={this.linkRef}
        headline={title || linkName}
        hasCloseIcon
        hasSmallHeadline
        primaryButtonProps={primaryButton}
        secondaryButtonProps={secondaryButton || defaultSecondaryButtonProps}
        onDismiss={this.toggleHelpBubble}
      >
        { description }
      </TeachingBubble> }
    </div>
  }
}

// Default props for LinkTeachingBubble.
LinkTeachingBubble.propTypes = {
  linkName: PropTypes.string.isRequired,
  title: PropTypes.string,
  description: PropTypes.string,
  primaryButton: PropTypes.object.isRequired,
  secondaryButton: PropTypes.object
}

export default LinkTeachingBubble
